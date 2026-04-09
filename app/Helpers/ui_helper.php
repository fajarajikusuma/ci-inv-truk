<?php

/**
 * Merender Card Statistik dengan Tailwind CSS
 */
function renderStats($title, $value, $icon, $color = 'primary')
{
    $themes = [
        'primary' => [
            'bg' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
            'icon' => 'fas fa-car-side'
        ],
        'success' => [
            'bg' => 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400',
            'icon' => 'fas fa-id-card'
        ],
        'warning' => [
            'bg' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400',
            'icon' => 'fas fa-users'
        ],
        'danger' => [
            'bg' => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
            // icon alert untuk menunjukkan urgensi
            'icon' => 'fas fa-exclamation-triangle',
            'card' => 'bg-red-50 dark:bg-red-700/30 border-red-300 dark:border-red-900/70'
        ],
    ];

    $t = $themes[$color] ?? $themes['primary'];
    $cardBg = $t['card'] ?? 'bg-white dark:bg-darkCard border-slate-200 dark:border-slate-800';

    return "
    <div class='{$cardBg} p-6 rounded-3xl border shadow-sm hover:shadow-md transition'>
        <div class='w-12 h-12 {$t['bg']} rounded-2xl flex items-center justify-center mb-4'>
            <i class='{$t['icon']} text-xl'></i>
        </div>
        <p class='text-xs font-bold uppercase tracking-wider text-slate-400 mb-1'>$title</p>
        <h2 class='text-3xl font-black'>$value</h2>
    </div>";
}