<?php

namespace Tests\Feature;

use App\Models\NewsItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class NewsPublicVisibilityTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_scheduled_items_only_appear_after_their_publish_time(): void
    {
        Carbon::setTestNow('2026-04-01 12:00:00');

        $visibleScheduled = $this->createNews([
            'title' => 'Visible Scheduled Story',
            'slug' => 'visible-scheduled-story',
            'status' => 'scheduled',
            'published_at' => '2026-04-01 11:00:00',
        ]);

        $hiddenScheduled = $this->createNews([
            'title' => 'Hidden Scheduled Story',
            'slug' => 'hidden-scheduled-story',
            'status' => 'scheduled',
            'published_at' => '2026-04-01 13:00:00',
        ]);

        $response = $this->get(route('news'));

        $response->assertOk();
        $response->assertSee($visibleScheduled->title);
        $response->assertDontSee($hiddenScheduled->title);
        $this->get(route('news.detail', $hiddenScheduled->slug))->assertNotFound();
    }

    public function test_published_items_with_future_dates_remain_visible(): void
    {
        Carbon::setTestNow('2026-04-01 12:00:00');

        $upcomingEvent = $this->createNews([
            'title' => 'Upcoming Published Event',
            'slug' => 'upcoming-published-event',
            'type' => 'event',
            'status' => 'published',
            'published_at' => '2026-04-08 09:00:00',
            'starts_at' => '2026-04-08 09:00:00',
            'ends_at' => '2026-04-10 17:00:00',
        ]);

        $response = $this->get(route('news'));

        $response->assertOk();
        $response->assertSee($upcomingEvent->title);
        $this->get(route('news.detail', $upcomingEvent->slug))->assertOk();
    }

    public function test_published_items_default_their_publish_time_when_missing(): void
    {
        Carbon::setTestNow('2026-04-01 12:00:00');

        $item = $this->createNews([
            'title' => 'Published Without Date',
            'slug' => 'published-without-date',
            'status' => 'published',
            'published_at' => null,
        ]);

        $this->assertNotNull($item->fresh()->published_at);
        $this->assertSame('2026-04-01 12:00:00', $item->fresh()->published_at?->format('Y-m-d H:i:s'));
    }

    protected function createNews(array $overrides = []): NewsItem
    {
        $sequence = NewsItem::count() + 1;

        return NewsItem::create(array_merge([
            'title' => 'News Item ' . $sequence,
            'slug' => 'news-item-' . $sequence,
            'type' => 'article',
            'status' => 'draft',
            'summary' => 'Summary for item ' . $sequence,
            'body' => '<p>Body for item ' . $sequence . '</p>',
        ], $overrides));
    }
}
