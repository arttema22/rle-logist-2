<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{
    Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When
};
use App\MoonShine\Resources\Driver\DriverSalaryResource;
use MoonShine\MenuManager\MenuItem;

final class DriverLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function getFaviconComponent(): Favicon
    {
        return parent::getFaviconComponent()->customAssets([
            'apple-touch' => 'favicon_path',
            '32' => 'favicon_path',
            '16' => 'favicon_path',
            'safari-pinned-tab' => 'favicon_path',
            'web-manifest' => 'favicon_path',
        ]);
    }

    protected function menu(): array
    {
        return [
            //  MenuItem::make('salaries', SalaryResource::class)->translatable('moonshine::ui.title'),
            // ...parent::menu(),

            MenuItem::make('salaries', DriverSalaryResource::class)->translatable('moonshine::ui.title'),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    protected function getFooterCopyright(): string
    {
        return \sprintf(
            <<<'HTML'
                &copy; 2022-%d
                HTML,
            now()->year,
        );
    }

    protected function getFooterMenu(): array
    {
        return [
            //        'https://example.com' => 'Custom link',
        ];
    }

    public function build(): Layout
    {
        // return parent::build();
        return Layout::make([
            Html::make([
                $this->getHeadComponent(),

                Body::make([
                    Wrapper::make([
                        Div::make([
                            Flash::make(),

                            Content::make([
                                Components::make(
                                    $this->getPage()->getComponents()
                                ),
                            ]),
                        ])->class('layout-page'),
                    ]),
                ])->class('theme-minimalistic'),
            ])
                ->customAttributes([
                    'lang' => $this->getHeadLang(),
                ])
                ->withAlpineJs()
                ->withThemes(),
        ]);
    }
}
