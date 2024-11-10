<?php

namespace Database\Seeders;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::create([
            'status' => true,
            'title_uk' => 'Голодні ігри: Переспівниця. Частина 1',
            'title_en' => 'The Hunger Games: Catching Fire. Part 1',
            'description_uk' => 'Фантастична картина «Голоднi iгри: Переспiвниця. Частина 1»знята відомим американським
            кінорежисером Френсісом Лоуренсом за романом Сьюзен Коллінз. Картина є третім фільмом із серії, і продовжує
             розповідати про неймовірні пригоди дівчини на ім`я Катнісс Евердін.  Незважаючи на те, що головна героїня
             Катнісс дуже молода, вона вже встигла пережити безліч суворих випробувань. Спочатку дівчина вийшла
             переможницею з арени щорічних «Голодних ігор», а потім їй з великими труднощами, але все ж таки вдалося
             здобути перемогу і в 75-х ювілейних «Голодних іграх». Після того як це сталося ідеальна система правління
             Капітолію дала збій.  Катнісс виявляється в Тринадцятому Дистрикті, в тому самому, жителі якого колись
             повстали проти тиранічного правління Капітолію. Всім сказали, що цей дистрикт був зруйнований, але як
             виявилося все далеко не так.  Уряд Капітолію усіма силами намагається вселити іншим Дистриктам, що все
             добре, однак люди втомилися від злиднів і голоду. Вони готові повстати, адже через довгі роки у них,
             нарешті, з`явилася надія в особі Катнісс Евердін, яка довела, що Капітолій не такий вже і сильний, яким
             він намагається себе показати',
            'description_en' => 'Fantastic picture "The Hunger Games: Catching Fire. Part 1" was filmed by a famous
            American by film director Francis Lawrence based on the novel by Susan Collins. The picture is the third
            film in the series, and continues tell about the incredible adventures of a girl named Katniss Everdeen.
            Despite the fact that the main character Katniss is very young, she has already managed to survive many
            severe trials. First, the girl came out the winner from the arena of the annual "Hunger Games", and then
            with great difficulty, but still succeeded to win the 75th anniversary "Hunger Games" as well. After this
             happened a perfect system of government The Capitol failed. Katniss finds herself in the Thirteenth
             District, the same one whose residents once were rebelled against the tyrannical rule of the Capitol.
             Everyone was told that this district was destroyed, but how everything turned out to be far from the case.
              The Government of the Capitol is trying with all its might to instill in other Districts that everything
              good, but people are tired of poverty and hunger. They are ready to rebel, because after many years they
              have finally, hope appeared in the person of Katniss Everdeen, who proved that the Capitol is not as
              strong as it seems he tries to show himself',
            'poster' => 'http://127.0.0.1:8000/storage/logo/page1.jpg', // шлях до постера
            'youtube_trailer_id' => 'USeDq-g3zpM?si=A0wdz4vcpf91Bhro', // ID трейлера на YouTube
            'release_year' => 2014,
            'view_start_date' => Carbon::create('2024', '11', '01', '10', '00'), // початок перегляду
            'view_end_date' => Carbon::create('2024', '11', '30', '23', '59'), // кінець перегляду
        ]);
    }
}
