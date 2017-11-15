<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(CategoryGroupSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(ConditionSeeder::class);
         $this->call(CitySeeder::class);
         $this->call(DeliverySeeder::class);
         $this->call(VihicleSeeder::class);
         //$this->call(AvailabilitiesSeeder::class);
         $this->call(DiameterSeeder::class);
         $this->call(CountSeeder::class);
         $this->call(TireWidthSeeder::class);
         $this->call(TireHeightSeeder::class);
         $this->call(TireSeasonSeeder::class);
         $this->call(TireBrandSeeder::class);
         $this->call(RimTypeSeeder::class);
         $this->call(RimWidthSeeder::class);
         $this->call(RimPcdSeeder::class);
         $this->call(RimEtSeeder::class);
         $this->call(RimDiaSeeder::class);

         $this->call(AutoServiceStatusesTableSeeder::class);
         $this->call(AutoServiceCategoriesTableSeeder::class);
         $this->call(AutoServiceInsuranceTypesTableSeeder::class);
         $this->call(AutoServiceModeOperationsTableSeeder::class);
         $this->call(AutoServiceWashingTypesTableSeeder::class);
    }
}

class UserTableSeeder extends Seeder {
    public function run()
    {
        \App\Models\User::create(array(
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123123'),
        ));
    }
}

class CategoryGroupSeeder extends Seeder
{
    public function run()
    {
       DB::table('category_groups')->delete();
        \App\Models\CategoryGroup::create([
           'name' => 'Автозвук и мультимедиа',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Автосвет',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Аксессуары',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Гаджеты',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Двигатель и выхлопная система',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Инструменты',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Климат',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Кузов',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Подвеска',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Рулевое управление',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Салон',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Тормозная система',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Трансмиссия',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Шины и диски',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Электрооборудование',
        ]);
        \App\Models\CategoryGroup::create([
            'name' => 'Другое',
        ]);
    }
}

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();
        \App\Models\Category::create([
            'name' => 'Акустика',
            'category_group_id' => '1',
        ]);
        \App\Models\Category::create([
            'name' => 'Камеры',
            'category_group_id' => '1',
        ]);
        \App\Models\Category::create([
            'name' => 'Магнитолы',
            'category_group_id' => '1',
        ]);
        \App\Models\Category::create([
            'name' => 'Мониторы/DVD',
            'category_group_id' => '1',
        ]);
        \App\Models\Category::create([
            'name' => 'Сабвуферы',
            'category_group_id' => '1',
        ]);
        \App\Models\Category::create([
            'name' => 'Усилители',
            'category_group_id' => '1',
        ]);
        \App\Models\Category::create([
            'name' => 'Дневные ходовые огни',
            'category_group_id' => '2',
        ]);
        \App\Models\Category::create([
            'name' => 'Лампочки',
            'category_group_id' => '2',
        ]);
        \App\Models\Category::create([
            'name' => 'Противотуманки',
            'category_group_id' => '2',
        ]);
        \App\Models\Category::create([
            'name' => 'Фары',
            'category_group_id' => '2',
        ]);
        \App\Models\Category::create([
            'name' => 'Фонари',
            'category_group_id' => '2',
        ]);
        \App\Models\Category::create([
            'name' => 'Багажники',
            'category_group_id' => '3',
        ]);
        \App\Models\Category::create([
            'name' => 'Коврики',
            'category_group_id' => '3',
        ]);
        \App\Models\Category::create([
            'name' => 'Сигнализации',
            'category_group_id' => '3',
        ]);
        \App\Models\Category::create([
            'name' => 'Фаркопы',
            'category_group_id' => '3',
        ]);
        \App\Models\Category::create([
            'name' => 'Чехлы',
            'category_group_id' => '3',
        ]);
        \App\Models\Category::create([
            'name' => 'Видеорегистраторы',
            'category_group_id' => '4',
        ]);
        \App\Models\Category::create([
            'name' => 'Навигаторы',
            'category_group_id' => '4',
        ]);
        \App\Models\Category::create([
            'name' => 'Парктроники',
            'category_group_id' => '4',
        ]);
        \App\Models\Category::create([
            'name' => 'Радар-детекторы',
            'category_group_id' => '4',
        ]);
        \App\Models\Category::create([
            'name' => 'Выхлопная система',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'ГБЦ',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'ГРМ',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'Моторы в сборе',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'Ремни',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'Система впуска',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'Система зажигания',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'Система охлаждения',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'Топливная система',
            'category_group_id' => '5',
        ]);
        \App\Models\Category::create([
            'name' => 'Турбины',
            'category_group_id' => '5',
        ]);

        \App\Models\Category::create([
            'name' => 'Адаптеры и сканеры',
            'category_group_id' => '6',
        ]);
        \App\Models\Category::create([
            'name' => 'Домкраты',
            'category_group_id' => '6',
        ]);
        \App\Models\Category::create([
            'name' => 'Наборы инструментов',
            'category_group_id' => '6',
        ]);

        \App\Models\Category::create([
            'name' => 'Компрессоры',
            'category_group_id' => '7',
        ]);
        \App\Models\Category::create([
            'name' => 'Кондиционеры',
            'category_group_id' => '7',
        ]);
        \App\Models\Category::create([
            'name' => 'Печки',
            'category_group_id' => '7',
        ]);

        \App\Models\Category::create([
            'name' => 'Бамперы',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Двери',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Зеркала',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Капоты',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Крылья',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Кузова',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Обвесы',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Пороги',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Решётки радиатора',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Спойлеры',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Стекла',
            'category_group_id' => '8',
        ]);
        \App\Models\Category::create([
            'name' => 'Другие элементы кузова',
            'category_group_id' => '8',
        ]);

        \App\Models\Category::create([
            'name' => 'Амортизаторы',
            'category_group_id' => '9',
        ]);
        \App\Models\Category::create([
            'name' => 'Подвеска в сборе',
            'category_group_id' => '9',
        ]);
        \App\Models\Category::create([
            'name' => 'Подшипники',
            'category_group_id' => '9',
        ]);
        \App\Models\Category::create([
            'name' => 'Пружины',
            'category_group_id' => '9',
        ]);
        \App\Models\Category::create([
            'name' => 'Рычаги',
            'category_group_id' => '9',
        ]);
        \App\Models\Category::create([
            'name' => 'Сайлентблоки',
            'category_group_id' => '9',
        ]);
        \App\Models\Category::create([
            'name' => 'Стойки',
            'category_group_id' => '9',
        ]);
        \App\Models\Category::create([
            'name' => 'Шаровые опоры',
            'category_group_id' => '9',
        ]);

        \App\Models\Category::create([
            'name' => 'ГУР',
            'category_group_id' => '10',
        ]);
        \App\Models\Category::create([
            'name' => 'Рулевые наконечники',
            'category_group_id' => '10',
        ]);
        \App\Models\Category::create([
            'name' => 'Рулевые рейки',
            'category_group_id' => '10',
        ]);
        \App\Models\Category::create([
            'name' => 'Рулевые тяги',
            'category_group_id' => '10',
        ]);

        \App\Models\Category::create([
            'name' => 'Дверные карты',
            'category_group_id' => '11',
        ]);
        \App\Models\Category::create([
            'name' => 'Обшивки потолка и стоек',
            'category_group_id' => '11',
        ]);
        \App\Models\Category::create([
            'name' => 'Панели приборов',
            'category_group_id' => '11',
        ]);
        \App\Models\Category::create([
            'name' => 'Рули',
            'category_group_id' => '11',
        ]);
        \App\Models\Category::create([
            'name' => 'Ручки КПП',
            'category_group_id' => '11',
        ]);
        \App\Models\Category::create([
            'name' => 'Салоны в сборе',
            'category_group_id' => '11',
        ]);
        \App\Models\Category::create([
            'name' => 'Сидения',
            'category_group_id' => '11',
        ]);
        \App\Models\Category::create([
            'name' => 'Другие части салона',
            'category_group_id' => '11',
        ]);

        \App\Models\Category::create([
            'name' => 'АБС',
            'category_group_id' => '12',
        ]);
        \App\Models\Category::create([
            'name' => 'Колодки',
            'category_group_id' => '12',
        ]);
        \App\Models\Category::create([
            'name' => 'Суппорты',
            'category_group_id' => '12',
        ]);
        \App\Models\Category::create([
            'name' => 'Тормозные диски',
            'category_group_id' => '12',
        ]);
        \App\Models\Category::create([
            'name' => 'Тормозные цилиндры',
            'category_group_id' => '12',
        ]);

        \App\Models\Category::create([
            'name' => 'АКПП',
            'category_group_id' => '13',
        ]);
        \App\Models\Category::create([
            'name' => 'Карданные валы',
            'category_group_id' => '13',
        ]);
        \App\Models\Category::create([
            'name' => 'МКПП',
            'category_group_id' => '13',
        ]);
        \App\Models\Category::create([
            'name' => 'Приводы',
            'category_group_id' => '13',
        ]);
        \App\Models\Category::create([
            'name' => 'Редукторы',
            'category_group_id' => '13',
        ]);
        \App\Models\Category::create([
            'name' => 'Сцепление',
            'category_group_id' => '13',
        ]);

        \App\Models\Category::create([
            'name' => 'Шины',
            'category_group_id' => '14',
        ]);
        \App\Models\Category::create([
            'name' => 'Диски',
            'category_group_id' => '14',
        ]);
        \App\Models\Category::create([
            'name' => 'Колёса в сборе',
            'category_group_id' => '14',
        ]);
        \App\Models\Category::create([
            'name' => 'Колпаки',
            'category_group_id' => '14',
        ]);
        \App\Models\Category::create([
            'name' => 'Проставки',
            'category_group_id' => '14',
        ]);

        \App\Models\Category::create([
            'name' => 'Аккумуляторы',
            'category_group_id' => '15',
        ]);
        \App\Models\Category::create([
            'name' => 'Блоки управления',
            'category_group_id' => '15',
        ]);
        \App\Models\Category::create([
            'name' => 'Генераторы',
            'category_group_id' => '15',
        ]);
        \App\Models\Category::create([
            'name' => 'Датчики',
            'category_group_id' => '15',
        ]);
        \App\Models\Category::create([
            'name' => 'Стартеры',
            'category_group_id' => '15',
        ]);

        \App\Models\Category::create([
            'name' => 'Масла',
            'category_group_id' => '16',
        ]);
        \App\Models\Category::create([
            'name' => 'Фильтры',
            'category_group_id' => '16',
        ]);
        \App\Models\Category::create([
            'name' => 'Разборка',
            'category_group_id' => '16',
        ]);
        \App\Models\Category::create([
            'name' => 'Разные детали и запчасти',
            'category_group_id' => '16',
        ]);

    }
}

class ConditionSeeder extends Seeder
{
    public function run()
    {
        DB::table('conditions')->delete();
        \App\Models\Condition::create([
            'name' => 'Новое',
        ]);
        \App\Models\Condition::create([
            'name' => 'Б/у',
        ]);
    }
}

class CitySeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->delete();
        \App\Models\City::create([
            'name' => 'Алматы',
        ]);
        \App\Models\City::create([
            'name' => 'Астана',
        ]);
        \App\Models\City::create([
            'name' => 'Актау',
        ]);
        \App\Models\City::create([
            'name' => 'Актобе',
        ]);
        \App\Models\City::create([
            'name' => 'Атырау',
        ]);
        \App\Models\City::create([
            'name' => 'Байконур',
        ]);
        \App\Models\City::create([
            'name' => 'Жезказган',
        ]);
        \App\Models\City::create([
            'name' => 'Караганда',
        ]);
        \App\Models\City::create([
            'name' => 'Кокшетау',
        ]);
        \App\Models\City::create([
            'name' => 'Костанай',
        ]);
        \App\Models\City::create([
            'name' => 'Кызылорда',
        ]);
        \App\Models\City::create([
            'name' => 'Павлодар',
        ]);
        \App\Models\City::create([
            'name' => 'Петропавловск',
        ]);
        \App\Models\City::create([
            'name' => 'Рудный',
        ]);
        \App\Models\City::create([
            'name' => 'Семей',
        ]);
        \App\Models\City::create([
            'name' => 'Талдыкорган',
        ]);
        \App\Models\City::create([
            'name' => 'Тараз',
        ]);
        \App\Models\City::create([
            'name' => 'Темиртау',
        ]);
        \App\Models\City::create([
            'name' => 'Уральск',
        ]);
        \App\Models\City::create([
            'name' => 'Шымкент',
        ]);
        \App\Models\City::create([
            'name' => 'Экибастуз',
        ]);
    }
}

class DeliverySeeder extends Seeder
{
    public function run()
    {
        DB::table('deliveries')->delete();
        \App\Models\Delivery::create([
            'name' => 'Самовывоз',
        ]);
        \App\Models\Delivery::create([
            'name' => 'Доставлю по городу',
        ]);
        \App\Models\Delivery::create([
            'name' => 'Могу отправить по стране',
        ]);
    }
}

class VihicleSeeder extends Seeder
{
    public function run()
    {
        DB::table('vehicle_brands')->delete();
        \App\Models\VehicleBrand::create([
            'name' => 'Audi',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'BMW',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Chevrolet',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Daewoo',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Honda',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Hyundai',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Infiniti',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'KIA',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Lexus',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Mazda',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Mercedes-Benz',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Mitsubishi',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Nissan',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Subaru',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Toyota',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Volkswagen',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Volvo',
        ]);
        \App\Models\VehicleBrand::create([
            'name' => 'Лада',
        ]);
    }
}

class AvailabilitiesSeeder extends Seeder
{
    public function run()
    {
        DB::table('availabilities')->delete();
        \App\Models\Availability::create([
            'name' => 'В наличие',
        ]);
        \App\Models\Availability::create([
            'name' => 'На заказ',
        ]);
    }
}

class DiameterSeeder extends Seeder
{
    public function run()
    {
        DB::table('diameters')->delete();
        \App\Models\Diameter::create([
            'name' => '12',
        ]);
        \App\Models\Diameter::create([
            'name' => '13',
        ]);
        \App\Models\Diameter::create([
            'name' => '14',
        ]);
        \App\Models\Diameter::create([
            'name' => '15',
        ]);
        \App\Models\Diameter::create([
            'name' => '16',
        ]);
        \App\Models\Diameter::create([
            'name' => '17',
        ]);
        \App\Models\Diameter::create([
            'name' => '18',
        ]);
        \App\Models\Diameter::create([
            'name' => '19',
        ]);
        \App\Models\Diameter::create([
            'name' => '20',
        ]);
        \App\Models\Diameter::create([
            'name' => '21',
        ]);
        \App\Models\Diameter::create([
            'name' => '22',
        ]);
        \App\Models\Diameter::create([
            'name' => '23',
        ]);
        \App\Models\Diameter::create([
            'name' => '24',
        ]);
        \App\Models\Diameter::create([
            'name' => '25',
        ]);
    }
}

class CountSeeder extends Seeder
{
    public function run()
    {
        DB::table('counts')->delete();
        \App\Models\Count::create([
            'name' => '1',
        ]);
        \App\Models\Count::create([
            'name' => '2',
        ]);
        \App\Models\Count::create([
            'name' => '3',
        ]);
        \App\Models\Count::create([
            'name' => '4',
        ]);
        \App\Models\Count::create([
            'name' => '5',
        ]);
    }
}

class TireWidthSeeder extends Seeder
{
    public function run()
    {
        DB::table('tire_widths')->delete();
        \App\Models\TireWidth::create([
            'name' => '125',
        ]);
        \App\Models\TireWidth::create([
            'name' => '135',
        ]);
        \App\Models\TireWidth::create([
            'name' => '145',
        ]);
        \App\Models\TireWidth::create([
            'name' => '155',
        ]);
        \App\Models\TireWidth::create([
            'name' => '165',
        ]);
        \App\Models\TireWidth::create([
            'name' => '175',
        ]);
        \App\Models\TireWidth::create([
            'name' => '185',
        ]);
        \App\Models\TireWidth::create([
            'name' => '195',
        ]);
        \App\Models\TireWidth::create([
            'name' => '205',
        ]);
        \App\Models\TireWidth::create([
            'name' => '215',
        ]);
        \App\Models\TireWidth::create([
            'name' => '225',
        ]);
        \App\Models\TireWidth::create([
            'name' => '235',
        ]);
        \App\Models\TireWidth::create([
            'name' => '245',
        ]);
        \App\Models\TireWidth::create([
            'name' => '255',
        ]);
        \App\Models\TireWidth::create([
            'name' => '265',
        ]);
        \App\Models\TireWidth::create([
            'name' => '275',
        ]);
        \App\Models\TireWidth::create([
            'name' => '285',
        ]);
        \App\Models\TireWidth::create([
            'name' => '295',
        ]);
    }
}

class TireHeightSeeder extends Seeder
{
    public function run()
    {
        DB::table('tire_heights')->delete();
        \App\Models\TireHeight::create([
            'name' => '25',
        ]);
        \App\Models\TireHeight::create([
            'name' => '30',
        ]);
        \App\Models\TireHeight::create([
            'name' => '35',
        ]);
        \App\Models\TireHeight::create([
            'name' => '40',
        ]);
        \App\Models\TireHeight::create([
            'name' => '45',
        ]);
        \App\Models\TireHeight::create([
            'name' => '50',
        ]);
        \App\Models\TireHeight::create([
            'name' => '55',
        ]);
        \App\Models\TireHeight::create([
            'name' => '60',
        ]);
        \App\Models\TireHeight::create([
            'name' => '65',
        ]);
        \App\Models\TireHeight::create([
            'name' => '70',
        ]);
        \App\Models\TireHeight::create([
            'name' => '75',
        ]);
        \App\Models\TireHeight::create([
            'name' => '80',
        ]);
        \App\Models\TireHeight::create([
            'name' => '85',
        ]);
        \App\Models\TireHeight::create([
            'name' => '90',
        ]);
    }
}

class TireSeasonSeeder extends Seeder
{
    public function run()
    {
        DB::table('tire_seasons')->delete();
        \App\Models\TireSeason::create([
            'name' => 'Летние',
        ]);
        \App\Models\TireSeason::create([
            'name' => 'Зимние без шипов',
        ]);
        \App\Models\TireSeason::create([
            'name' => 'Зимние с шипами',
        ]);
        \App\Models\TireSeason::create([
            'name' => 'Всесезонные',
        ]);
    }
}

class TireBrandSeeder extends Seeder
{
    public function run()
    {
        DB::table('tire_brands')->delete();
        \App\Models\TireBrand::create([
            'name' => 'Accelera',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Achilles',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Aeolus',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Amtel',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Apollo',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Avon',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Barum',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'BFGoodrich',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Bridgestone',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Continental',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Cooper',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Cordiant',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Dunlop',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Effiplus',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Falken',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Federal',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Firestone',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Fulda',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Gislaved',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Goodride',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Goodyear',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'GT Radial',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Hankook',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Headway',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Hifly',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Imperial',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Infinity',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Interstate',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Kingstar',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Kleber',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Kormoran',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Kumho',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Marangoni',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Marshal',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Matador',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Maxtrek',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Maxxis',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Michelin',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Mickey Thompson',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Minerva',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Mitas',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Nankang',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Nexen',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Nitto',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Nokian',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Ovation',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Petlas',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Pirelli',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Riken',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Roadstone',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Rosava',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Sailun',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Satoya',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Sava',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Semperit',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Silverstone',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Sonar',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Starperformer',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Sunny',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Tigar',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Toyo',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Triangle Group',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Tunga',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Uniroyal',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Viatti',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Vredestein',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Wanli',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Westlake Tyres',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Yokohama',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Zeetex',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Белшина',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Кама',
        ]);
        \App\Models\TireBrand::create([
            'name' => 'Другая марка',
        ]);
    }
}

class RimTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('rim_types')->delete();
        \App\Models\RimType::create([
            'name' => 'Штампованные',
        ]);
        \App\Models\RimType::create([
            'name' => 'Литые',
        ]);
        \App\Models\RimType::create([
            'name' => 'Кованые',
        ]);
    }
}

class RimWidthSeeder extends Seeder
{
    public function run()
    {
        DB::table('rim_widths')->delete();
        \App\Models\RimWidth::create([
            'name' => '4',
        ]);
        \App\Models\RimWidth::create([
            'name' => '4.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '5.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '6',
        ]);
        \App\Models\RimWidth::create([
            'name' => '6.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '7',
        ]);
        \App\Models\RimWidth::create([
            'name' => '7.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '8',
        ]);
        \App\Models\RimWidth::create([
            'name' => '8.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '9',
        ]);
        \App\Models\RimWidth::create([
            'name' => '9.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '10',
        ]);
        \App\Models\RimWidth::create([
            'name' => '10.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '11',
        ]);
        \App\Models\RimWidth::create([
            'name' => '11.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '12',
        ]);
        \App\Models\RimWidth::create([
            'name' => '12.5',
        ]);
        \App\Models\RimWidth::create([
            'name' => '13',
        ]);
        \App\Models\RimWidth::create([
            'name' => '13.5',
        ]);
    }
}

class RimPcdSeeder extends Seeder
{
    public function run()
    {
        DB::table('rim_pcds')->delete();
        \App\Models\RimPcd::create([
            'name' => '3x98',
        ]);
        \App\Models\RimPcd::create([
            'name' => '3x112',
        ]);
        \App\Models\RimPcd::create([
            'name' => '3x220',
        ]);
        \App\Models\RimPcd::create([
            'name' => '3x256',
        ]);
        \App\Models\RimPcd::create([
            'name' => '4x98',
        ]);
        \App\Models\RimPcd::create([
            'name' => '4x100',
        ]);
        \App\Models\RimPcd::create([
            'name' => '4x108',
        ]);
        \App\Models\RimPcd::create([
            'name' => '4x114,3',
        ]);
        \App\Models\RimPcd::create([
            'name' => '4x256',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x98',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x100',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x105',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x107,95',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x108',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x110',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x112',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x114,3',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x115',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x118',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x120',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x120,65',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x127',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x130',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x135',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x139,7',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x150',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x160',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x165',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x175',
        ]);
        \App\Models\RimPcd::create([
            'name' => '5x208',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x114,3',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x120',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x127',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x130',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x135',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x139,7',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x140',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x148',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x164',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x170',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x175',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x180',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x190',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x200',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x205',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x210',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x222',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x222,25',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x222,5',
        ]);
        \App\Models\RimPcd::create([
            'name' => '6x245',
        ]);
    }
}

class RimEtSeeder extends Seeder
{
    public function run()
    {
        DB::table('rim_ets')->delete();
        \App\Models\RimEt::create([
            'name' => '-65',
        ]);
        \App\Models\RimEt::create([
            'name' => '-50',
        ]);
        \App\Models\RimEt::create([
            'name' => '-44',
        ]);
        \App\Models\RimEt::create([
            'name' => '-40',
        ]);
        \App\Models\RimEt::create([
            'name' => '-36',
        ]);
        \App\Models\RimEt::create([
            'name' => '-35',
        ]);
        \App\Models\RimEt::create([
            'name' => '-32',
        ]);
        \App\Models\RimEt::create([
            'name' => '-30',
        ]);
        \App\Models\RimEt::create([
            'name' => '-28',
        ]);
        \App\Models\RimEt::create([
            'name' => '-25',
        ]);
        \App\Models\RimEt::create([
            'name' => '-24',
        ]);
        \App\Models\RimEt::create([
            'name' => '-22',
        ]);
        \App\Models\RimEt::create([
            'name' => '-20',
        ]);
        \App\Models\RimEt::create([
            'name' => '-16',
        ]);
        \App\Models\RimEt::create([
            'name' => '-15',
        ]);
        \App\Models\RimEt::create([
            'name' => '-14',
        ]);
        \App\Models\RimEt::create([
            'name' => '-13',
        ]);
        \App\Models\RimEt::create([
            'name' => '-12',
        ]);
        \App\Models\RimEt::create([
            'name' => '-10',
        ]);
        \App\Models\RimEt::create([
            'name' => '-8',
        ]);
        \App\Models\RimEt::create([
            'name' => '-7',
        ]);
        \App\Models\RimEt::create([
            'name' => '-6',
        ]);
        \App\Models\RimEt::create([
            'name' => '-5',
        ]);
        \App\Models\RimEt::create([
            'name' => '-2',
        ]);
        \App\Models\RimEt::create([
            'name' => '0',
        ]);
        \App\Models\RimEt::create([
            'name' => '1',
        ]);
        \App\Models\RimEt::create([
            'name' => '2',
        ]);
        \App\Models\RimEt::create([
            'name' => '3',
        ]);
        \App\Models\RimEt::create([
            'name' => '4',
        ]);
        \App\Models\RimEt::create([
            'name' => '5',
        ]);
        \App\Models\RimEt::create([
            'name' => '6',
        ]);
        \App\Models\RimEt::create([
            'name' => '7',
        ]);
        \App\Models\RimEt::create([
            'name' => '8',
        ]);
        \App\Models\RimEt::create([
            'name' => '9',
        ]);
        \App\Models\RimEt::create([
            'name' => '10',
        ]);
        \App\Models\RimEt::create([
            'name' => '11',
        ]);
        \App\Models\RimEt::create([
            'name' => '12',
        ]);
        \App\Models\RimEt::create([
            'name' => '13',
        ]);
        \App\Models\RimEt::create([
            'name' => '14',
        ]);
        \App\Models\RimEt::create([
            'name' => '15',
        ]);
        \App\Models\RimEt::create([
            'name' => '16',
        ]);
        \App\Models\RimEt::create([
            'name' => '17',
        ]);
        \App\Models\RimEt::create([
            'name' => '18',
        ]);
        \App\Models\RimEt::create([
            'name' => '19',
        ]);
        \App\Models\RimEt::create([
            'name' => '20',
        ]);
        \App\Models\RimEt::create([
            'name' => '21',
        ]);
        \App\Models\RimEt::create([
            'name' => '22',
        ]);
        \App\Models\RimEt::create([
            'name' => '23',
        ]);
        \App\Models\RimEt::create([
            'name' => '23,5',
        ]);
        \App\Models\RimEt::create([
            'name' => '24',
        ]);
        \App\Models\RimEt::create([
            'name' => '24',
        ]);
        \App\Models\RimEt::create([
            'name' => '25',
        ]);
        \App\Models\RimEt::create([
            'name' => '26',
        ]);
        \App\Models\RimEt::create([
            'name' => '27',
        ]);
        \App\Models\RimEt::create([
            'name' => '28',
        ]);
        \App\Models\RimEt::create([
            'name' => '29',
        ]);
        \App\Models\RimEt::create([
            'name' => '30',
        ]);
        \App\Models\RimEt::create([
            'name' => '31',
        ]);
        \App\Models\RimEt::create([
            'name' => '31,5',
        ]);
        \App\Models\RimEt::create([
            'name' => '32',
        ]);
        \App\Models\RimEt::create([
            'name' => '33',
        ]);
        \App\Models\RimEt::create([
            'name' => '34',
        ]);
        \App\Models\RimEt::create([
            'name' => '35',
        ]);
        \App\Models\RimEt::create([
            'name' => '36',
        ]);
        \App\Models\RimEt::create([
            'name' => '36,5',
        ]);
        \App\Models\RimEt::create([
            'name' => '37',
        ]);
        \App\Models\RimEt::create([
            'name' => '37,5',
        ]);
        \App\Models\RimEt::create([
            'name' => '38',
        ]);
        \App\Models\RimEt::create([
            'name' => '39',
        ]);
        \App\Models\RimEt::create([
            'name' => '39,5',
        ]);
        \App\Models\RimEt::create([
            'name' => '40',
        ]);
        \App\Models\RimEt::create([
            'name' => '40,5',
        ]);
        \App\Models\RimEt::create([
            'name' => '41',
        ]);
        \App\Models\RimEt::create([
            'name' => '41,5',
        ]);
        \App\Models\RimEt::create([
            'name' => '42',
        ]);
        \App\Models\RimEt::create([
            'name' => '43',
        ]);
        \App\Models\RimEt::create([
            'name' => '43,5',
        ]);
    }
}

class RimDiaSeeder extends Seeder
{
    public function run()
    {
        DB::table('rim_dias')->delete();
        \App\Models\RimDia::create([
            'name' => '48,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '52,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '54,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '55,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '56,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '56,5',
        ]);
        \App\Models\RimDia::create([
            'name' => '56,6',
        ]);
        \App\Models\RimDia::create([
            'name' => '57,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '58,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '58,6',
        ]);
        \App\Models\RimDia::create([
            'name' => '59,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '59,6',
        ]);
        \App\Models\RimDia::create([
            'name' => '60,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '63,3',
        ]);
        \App\Models\RimDia::create([
            'name' => '63,4',
        ]);
        \App\Models\RimDia::create([
            'name' => '64,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '65,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '66,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '66,6',
        ]);
        \App\Models\RimDia::create([
            'name' => '67,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '68,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '69,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '69,5',
        ]);
        \App\Models\RimDia::create([
            'name' => '70,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '70,3',
        ]);
        \App\Models\RimDia::create([
            'name' => '70,6',
        ]);
        \App\Models\RimDia::create([
            'name' => '71,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '71,6',
        ]);
        \App\Models\RimDia::create([
            'name' => '72,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '72,6',
        ]);
        \App\Models\RimDia::create([
            'name' => '73,8',
        ]);
        \App\Models\RimDia::create([
            'name' => '74,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '77,8',
        ]);
        \App\Models\RimDia::create([
            'name' => '78,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '84,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '86,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '86,5',
        ]);
        \App\Models\RimDia::create([
            'name' => '87,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '89,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '92,5',
        ]);
        \App\Models\RimDia::create([
            'name' => '93,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '95,5',
        ]);
        \App\Models\RimDia::create([
            'name' => '95,5',
        ]);
        \App\Models\RimDia::create([
            'name' => '98,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '100,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '104,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '105,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '106,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '107,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '108,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '110,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '113,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '114,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '116,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '117',
        ]);
        \App\Models\RimDia::create([
            'name' => '121',
        ]);
        \App\Models\RimDia::create([
            'name' => '124,1',
        ]);
        \App\Models\RimDia::create([
            'name' => '125',
        ]);
        \App\Models\RimDia::create([
            'name' => '95,5',
        ]);
        \App\Models\RimDia::create([
            'name' => '130',
        ]);
        \App\Models\RimDia::create([
            'name' => '142,1',
        ]);
    }
}

class AutoServiceStatusesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('auto_services_statuses')->delete();
        \App\Models\AutoServicesStatus::create(array(
            'title' => 'Все',
            'slug' => 'all'
        ));
        \App\Models\AutoServicesStatus::create(array(
            'title' => 'Неавторизованные',
            'slug' => 'independent'
        ));
        \App\Models\AutoServicesStatus::create(array(
            'title' => 'Авторизованные',
            'slug' => 'authorized'
        ));
    }
}

class AutoServiceCategoriesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('auto_services_categories')->delete();
        \App\Models\AutoServicesCategory::create(array(
            'title' => 'СТО',
            'slug' => Str::slug('СТО')
        ));
        \App\Models\AutoServicesCategory::create(array(
            'title' => 'АЗС',
            'slug' => Str::slug('АЗС')
        ));
        \App\Models\AutoServicesCategory::create(array(
            'title' => 'Автомойки',
            'slug' => Str::slug('Автомойки')
        ));
        \App\Models\AutoServicesCategory::create(array(
            'title' => 'Шиномонтажи',
            'slug' => Str::slug('Шиномонтажи')
        ));
        \App\Models\AutoServicesCategory::create(array(
            'title' => 'Прокат авто',
            'slug' => Str::slug('Прокат авто')
        ));
        \App\Models\AutoServicesCategory::create(array(
            'title' => 'Автострахование',
            'slug' => Str::slug('Автострахование')
        ));
        \App\Models\AutoServicesCategory::create(array(
            'title' => 'Автосалоны',
            'slug' => Str::slug('Автосалоны')
        ));
        \App\Models\AutoServicesCategory::create(array(
            'title' => 'Авторазборки',
            'slug' => Str::slug('Авторазборки')
        ));
    }
}

class AutoServiceInsuranceTypesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('auto_services_insurance_types')->delete();
        \App\Models\AutoServicesInsuranceType::create(array(
            'title' => 'Все',
            'slug' => Str::slug('Все')
        ));
        \App\Models\AutoServicesInsuranceType::create(array(
            'title' => 'ОГПО',
            'slug' => Str::slug('ОГПО')
        ));
        \App\Models\AutoServicesInsuranceType::create(array(
            'title' => 'КАСКО',
            'slug' => Str::slug('КАСКО')
        ));
    }
}

class AutoServiceModeOperationsTableSeeder extends Seeder {
    public function run()
    {
        DB::table('auto_services_mode_operations')->delete();
        \App\Models\AutoServicesModeOperation::create(array(
            'title' => 'Все',
            'slug' => Str::slug('Все')
        ));
        \App\Models\AutoServicesModeOperation::create(array(
            'title' => 'Круглосуточно',
            'slug' => Str::slug('Круглосуточно')
        ));
        \App\Models\AutoServicesModeOperation::create(array(
            'title' => 'Не круглосуточно',
            'slug' => Str::slug('Не круглосуточно')
        ));
    }
}

class AutoServiceWashingTypesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('auto_services_washing_types')->delete();
        \App\Models\AutoServicesWashingType::create(array(
            'title' => 'Все',
            'slug' => Str::slug('Все')
        ));
        \App\Models\AutoServicesWashingType::create(array(
            'title' => 'Ручные',
            'slug' => Str::slug('Ручные')
        ));
        \App\Models\AutoServicesWashingType::create(array(
            'title' => 'Бесконтактные',
            'slug' => Str::slug('Бесконтактные')
        ));
    }
}
