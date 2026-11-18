<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $slugBaru = ! Schema::hasColumn('campaigns', 'slug');

        if ($slugBaru) {
            Schema::table('campaigns', function (Blueprint $table) {
                $table->string('slug')->nullable();
            });
        }

        // Isi slug untuk data lama (judul + id supaya pasti unik)
        DB::table('campaigns')
            ->where(fn ($q) => $q->whereNull('slug')->orWhere('slug', ''))
            ->get()
            ->each(function ($campaign) {
                DB::table('campaigns')
                    ->where('id', $campaign->id)
                    ->update(['slug' => Str::slug($campaign->judul) . '-' . $campaign->id]);
            });

        if ($slugBaru) {
            Schema::table('campaigns', function (Blueprint $table) {
                $table->unique('slug');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('campaigns', 'slug')) {
            Schema::table('campaigns', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }
    }
};