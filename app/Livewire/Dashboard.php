<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

#[Title('Analytics Dashboard')]
class Dashboard extends AdminComponent
{
    public $users = [];
    public $posts = [];
    public $realTimeData = [];
    public $salesData = [];
    public $articlesData = [];

    public function mount()
    {
        $this->loadUsersData();
        $this->loadPostsData();
        $this->generateRealTimeData();
        $this->generateSalesData();
        $this->generateArticlesData();
    }

    public function loadUsersData()
    {
        try {
            $response = Http::timeout(5)->get('https://jsonplaceholder.typicode.com/users');
            $this->users = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $this->users = [];
        }
    }

    public function loadPostsData()
    {
        try {
            $response = Http::timeout(5)->get('https://jsonplaceholder.typicode.com/posts');
            if ($response->successful()) {
                $posts = collect($response->json());

                $this->posts = $posts->groupBy('userId')
                    ->map(function ($userPosts, $userId) {
                        return [
                            'userId' => $userId,
                            'count' => $userPosts->count(),
                            'user' => $this->getUserName($userId)
                        ];
                    })
                    ->take(8)
                    ->values()
                    ->toArray();
            }
        } catch (\Exception $e) {
            $this->posts = [];
        }
    }

    private function getUserName($userId)
    {
        $user = collect($this->users)->firstWhere('id', $userId);
        return $user ? $user['name'] : "User {$userId}";
    }

    public function generateRealTimeData()
    {
        $this->realTimeData = [
            'visitors' => rand(100, 500),
            'sales' => rand(50, 200),
            'revenue' => rand(1000, 5000),
            'conversions' => rand(10, 50),
            'timestamp' => now()->format('H:i:s')
        ];
    }

    public function generateSalesData()
    {
        $this->salesData = collect(range(1, 12))
            ->map(function ($month) {
                return [
                    'month' => date('M', mktime(0, 0, 0, $month, 1)),
                    'sales' => rand(1000, 8000),
                    'revenue' => rand(10000, 80000),
                    'customers' => rand(50, 300)
                ];
            })
            ->toArray();
    }

    public function generateArticlesData()
    {
        // Last 6 months including current
        $months = collect(range(0, 5))->map(function ($i) {
            $dt = now()->subMonths(5 - $i);
            return [
                'label' => $dt->format('M'),
                'year' => (int) $dt->format('Y'),
                'month' => (int) $dt->format('m'),
            ];
        });

        $driver = DB::connection()->getDriverName();
        // Build a YYYY-MM key using database-specific date formatting
        if ($driver === 'sqlite') {
            $ymSelect = "strftime('%Y-%m', created_at) as ym";
        } elseif ($driver === 'mysql') {
            $ymSelect = "DATE_FORMAT(created_at, '%Y-%m') as ym";
        } elseif ($driver === 'pgsql') {
            $ymSelect = "to_char(created_at, 'YYYY-MM') as ym";
        } else {
            // Fallback: try ISO 8601 cast and substring (works for many drivers)
            $ymSelect = "substr(cast(created_at as text),1,7) as ym";
        }

        $from = now()->subMonths(5)->startOfMonth();

        $counts = DB::table('articles')
            ->selectRaw($ymSelect . ', COUNT(*) as c')
            ->where('created_at', '>=', $from)
            ->groupBy('ym')
            ->pluck('c', 'ym');

        $this->articlesData = $months->map(function ($item) use ($counts) {
            $key = sprintf('%04d-%02d', $item['year'], $item['month']);
            return [
                'month' => $item['label'],
                'count' => (int) ($counts[$key] ?? 0),
            ];
        })->toArray();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
