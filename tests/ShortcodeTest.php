<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__).'/includes/class-shortcode.php';

final class ShortcodeTest extends TestCase
{
    public function test_it_skips_empty_questions_and_keeps_answers(): void
    {
        $items = Pnscripts_Faq_Accordion_Shortcode::sanitize_items([
            ['question' => '', 'answer' => 'ignored'],
            ['question' => '   ', 'answer' => 'also ignored'],
            ['question' => '<b>What is MIT?</b>', 'answer' => 'A license.'],
            ['question' => 'Shipping', 'answer' => ''],
        ]);

        $this->assertCount(2, $items);
        $this->assertSame('What is MIT?', $items[0]['question']);
        $this->assertSame('A license.', $items[0]['answer']);
        $this->assertSame('Shipping', $items[1]['question']);
        $this->assertSame('', $items[1]['answer']);
    }
}
