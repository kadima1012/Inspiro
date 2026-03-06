<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add indexes on foreign keys for artist table
        Schema::table('artist', function (Blueprint $table) {
            $table->index('idUser');
        });

        // Add indexes on foreign keys for artwork table
        Schema::table('artwork', function (Blueprint $table) {
            $table->index('idArtist');
            $table->index('idArtworkType');
            $table->index('art_Status');
        });

        // Add indexes on foreign keys for orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->index('idUser');
            $table->index('idArtist');
            $table->index('order_status');
        });

        // Add indexes on foreign keys for review table
        Schema::table('review', function (Blueprint $table) {
            $table->index('idUser');
            $table->index('idArtwork');
        });

        // Add indexes on foreign keys for event_participation table
        Schema::table('event_participation', function (Blueprint $table) {
            $table->index('idUser');
            $table->index('IdEvents');
        });

        // Add foreign key for msg.senderID
        Schema::table('msg', function (Blueprint $table) {
            $table->foreign('senderID')->references('idUser')->on('users');
            $table->index('senderID');
            $table->index('idUser');
        });

        // Add cascade deletes where missing

        // artwork -> artist (cascade on artist delete)
        Schema::table('artwork', function (Blueprint $table) {
            $table->dropForeign(['idArtist']);
            $table->foreign('idArtist')->references('idArtist')->on('artist')->onDelete('cascade');
        });

        // shop_list -> artwork and artist (cascade)
        Schema::table('shop_list', function (Blueprint $table) {
            $table->dropForeign(['idArt']);
            $table->dropForeign(['idArtist']);
            $table->foreign('idArt')->references('idArt')->on('artwork')->onDelete('cascade');
            $table->foreign('idArtist')->references('idArtist')->on('artist')->onDelete('cascade');
        });

        // review -> artwork (cascade)
        Schema::table('review', function (Blueprint $table) {
            $table->dropForeign(['idArtwork']);
            $table->dropForeign(['idUser']);
            $table->foreign('idArtwork')->references('idArt')->on('artwork')->onDelete('cascade');
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');
        });

        // orders -> artist (cascade)
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['idArtist']);
            $table->foreign('idArtist')->references('idArtist')->on('artist')->onDelete('cascade');
        });

        // art_medium -> artwork (cascade)
        if (Schema::hasTable('art_medium')) {
            Schema::table('art_medium', function (Blueprint $table) {
                $table->dropForeign(['idArt']);
                $table->foreign('idArt')->references('idArt')->on('artwork')->onDelete('cascade');
            });
        }

        // art_style -> artwork (cascade)
        if (Schema::hasTable('art_style')) {
            Schema::table('art_style', function (Blueprint $table) {
                $table->dropForeign(['idArt']);
                $table->foreign('idArt')->references('idArt')->on('artwork')->onDelete('cascade');
            });
        }

        // main_medium -> artist (cascade)
        if (Schema::hasTable('main_medium')) {
            Schema::table('main_medium', function (Blueprint $table) {
                $table->dropForeign(['idArtist']);
                $table->foreign('idArtist')->references('idArtist')->on('artist')->onDelete('cascade');
            });
        }

        // main_style -> artist (cascade)
        if (Schema::hasTable('main_style')) {
            Schema::table('main_style', function (Blueprint $table) {
                $table->dropForeign(['idArtist']);
                $table->foreign('idArtist')->references('idArtist')->on('artist')->onDelete('cascade');
            });
        }

        // event_participation -> events (cascade)
        Schema::table('event_participation', function (Blueprint $table) {
            $table->dropForeign(['IdEvents']);
            $table->dropForeign(['idUser']);
            $table->foreign('IdEvents')->references('IdEvents')->on('events')->onDelete('cascade');
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');
        });

        // msg_convos cascades
        Schema::table('msg_convos', function (Blueprint $table) {
            $table->dropForeign(['idMessage']);
            $table->dropForeign(['Id_Conversation']);
            $table->foreign('idMessage')->references('idMessage')->on('msg')->onDelete('cascade');
            $table->foreign('Id_Conversation')->references('Id_Conversation')->on('convos')->onDelete('cascade');
        });

        // convos -> users (cascade)
        Schema::table('convos', function (Blueprint $table) {
            $table->dropForeign(['idUser']);
            $table->dropForeign(['idUser_1']);
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');
            $table->foreign('idUser_1')->references('idUser')->on('users')->onDelete('cascade');
        });

        // msg -> users (cascade)
        Schema::table('msg', function (Blueprint $table) {
            $table->dropForeign(['idUser']);
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');
        });

        // lives -> users (cascade)
        Schema::table('lives', function (Blueprint $table) {
            $table->dropForeign(['idUser']);
            $table->foreign('idUser')->references('idUser')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Reverting all these changes would be complex and error-prone.
        // The original migrations handle the base schema.
    }
};
