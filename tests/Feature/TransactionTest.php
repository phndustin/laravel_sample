<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\WithAccessToken;
use Illuminate\Testing\Fluent\AssertableJson;
use Excel;
use App\Exports\TransactionExport;

class TransactionTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithAccessToken;

    protected function setUp(): void {
        parent::setUp();
        $this->mockingService();
        $this->initAccessToken();
    }

    public function test_list() {
        $this->withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])
            ->getJson('/api/transactions')
            ->assertStatus(200);
    }

    public function test_export() {
        Excel::fake();
        $this->withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])
            ->get('/api/transactions/export');
        Excel::assertDownloaded('transaction_report.xlsx');
    }
}
