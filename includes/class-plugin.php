<?php

declare(strict_types=1);

final class Pnscripts_Faq_Accordion_Plugin
{
    private static ?self $instance = null;

    public static function instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function register(): void
    {
        (new Pnscripts_Faq_Accordion_Cpt())->register();
        (new Pnscripts_Faq_Accordion_Shortcode())->register();
    }
}
