<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            // Hapus foreign key lama yang tidak ada constraint-nya
            $table->dropColumn('news_id');
        });

    Schema::table('banners', function (Blueprint $table) {
             // Tambah ulang dengan constrained + cascade
            $table->foreignId('news_id')->constrained()->onDelete('cascade');
            // Tambah kolom image yang hilang
            $table->string('image')->nullable()->after('news_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('banners', function (Blueprint $table) {
        $table->dropForeign(['news_id']);
        $table->dropColumn(['news_id', 'image']);
        $table->foreignId('news_id');
    });
    }
};
