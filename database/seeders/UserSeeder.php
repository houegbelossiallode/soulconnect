<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Clara',
                'email' => 'clara@example.com',
                'password' => Hash::make('password'),
                'gender' => 'women',
                'city' => 'Paris',
                'birthday' => Carbon::now()->subYears(24),
                'bio' => json_encode(['fr' => 'Artiste peintre à ses heures perdues. Je cherche quelqu\'un pour refaire le monde...', 'en' => 'Painter artist in her spare time. Looking for someone to rewrite the world...', 'es' => 'Artista pintora en sus ratos libres. Busco a alguien para rehacer el mundo...']),
            ],
            [
                'name' => 'Marc',
                'email' => 'marc@example.com',
                'password' => Hash::make('password'),
                'gender' => 'men',
                'city' => 'Lyon',
                'birthday' => Carbon::now()->subYears(30),
                'bio' => json_encode(['fr' => 'Passionné de randonnée et de gastronomie. Lyon est mon terrain de jeu.', 'en' => 'Passionate about hiking and gastronomy. Lyon is my playground.', 'es' => 'Apasionado del senderismo y la gastronomía. Lyon es mi patio de recreo.']),
            ],
            [
                'name' => 'Sophie',
                'email' => 'sophie@example.com',
                'password' => Hash::make('password'),
                'gender' => 'women',
                'city' => 'Marseille',
                'birthday' => Carbon::now()->subYears(28),
                'bio' => json_encode(['fr' => 'Le soleil, la mer et un bon livre. Que demander de plus ?', 'en' => 'The sun, the sea and a good book. What more could you ask for?', 'es' => 'El sol, el mar y un buen libro. ¿Qué más se puede pedir?']),
            ],
            [
                'name' => 'Thomas',
                'email' => 'thomas@example.com',
                'password' => Hash::make('password'),
                'gender' => 'men',
                'city' => 'Paris',
                'birthday' => Carbon::now()->subYears(22),
                'bio' => json_encode(['fr' => 'Étudiant en architecture, j\'aime explorer les rues de Paris.', 'en' => 'Architecture student, I love exploring the streets of Paris.', 'es' => 'Estudiante de arquitectura, me encanta explorar las calles de París.']),
            ],
            [
                'name' => 'Elena',
                'email' => 'elena@example.com',
                'password' => Hash::make('password'),
                'gender' => 'women',
                'city' => 'Bordeaux',
                'birthday' => Carbon::now()->subYears(35),
                'bio' => json_encode(['fr' => 'Amoureuse du vin et des longues balades sur la plage.', 'en' => 'Lover of wine and long walks on the beach.', 'es' => 'Amante del vino y de los largos paseos por la playa.']),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(['email' => $userData['email']], $userData);
        }
    }
}
