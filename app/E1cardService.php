<?php

namespace App;

use App\Models\User;
use App\Models\Refilling;
use MoonShine\Models\MoonshineUser;
use App\Models\Dir\DirPetrolStation;
use App\Models\Sys\SetupIntegration;
use Illuminate\Support\Facades\Http;
use App\MoonShine\Controllers\IntegrationRefillingController;

class E1cardService
{
    /**
     * callAuth
     * Аутентификация. Получение токена.
     * HTTP-метод: POST
     * Адрес метода: /token
     * @return void
     */
    public function callAuth()
    {
        $data = SetupIntegration::find(1);
        $response = Http::asForm()->post(
            $data->url . '/token',
            [
                'client_id' => 'external_app',
                'username' => $data->user_name,
                'password' => $data->password,
            ]
        )->json();

        if (isset($response)) {
            $data->update([
                'access_token' => $response['data']['access_token'],
            ]);
        }
    }

    /**
     * callTransaction
     * Транзакции по договору (Transaction)
     * Метод, возвращающий информацию по транзакциям.
     * HTTP-метод: POST
     * Адрес метода: /transactions
     * @return void
     */
    public function callTransaction()
    {
        $this->callAuth(); // получаем токен

        $data = SetupIntegration::find(1); // получаем настройки интеграции
        // получаем список карточек.
        $cards = User::whereNotNull('e1_card')->pluck('e1_card')->toArray();

        // запрос на получение всех записей о заправках
        $response = Http::accept('application/json')
            ->withHeaders([
                'access-token' => $data->access_token,
            ])
            ->post(
                $data->url . '/transactions',
                [
                    'lang' => 'ru',
                    'from' => date('Y-m-d'),
                    'cards' => $cards,
                ]
            )->json();

        // если в ответе есть записи, то выполняется цикл
        if (isset($response['transactions'])) {
            foreach ($response['transactions'] ?? [] as $transaction) {

                // если НЕ найдено записей о заправке с уникальным идентификатором, то делается запись
                if (!Refilling::where('integration_id', $transaction['UnID'])->exists()) {

                    // Получение ID бренда топливной компании
                    $brand = DirPetrolStation::where('title', $transaction['brand'])->first();
                    // Если в базе нет такого бренда, то он создается
                    if (!$brand) {
                        $brand = DirPetrolStation::create([
                            'title' => $transaction['brand'],
                        ]);
                    }

                    // Поиск водителя
                    $driver = User::where('e1_card', $transaction['card'])->first();
                    // Если водитель с карточкой существует, то создается запись о заправке
                    if ($driver) {
                        Refilling::create([
                            'date' => date('Y-m-d H:i', strtotime($transaction['date'])),
                            'owner_id' => 1,
                            'driver_id' => $driver->id,
                            'petrol_stations_id' => $brand->id,
                            'num_liters_car_refueling' => $transaction['volume'],
                            'price_car_refueling' => env('PRICE_CAR_REFUELING', 48),
                            'cost_car_refueling' => $transaction['volume'] * env('PRICE_CAR_REFUELING', 48),
                            'integration_id' => $transaction['UnID'],
                        ]);
                    };
                };
            }
        }
    }
}
