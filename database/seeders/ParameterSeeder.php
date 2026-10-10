<?php

namespace Database\Seeders;

use App\Models\Parameter;
use App\Models\ParameterRubric;
use App\Models\Rubric;
use Illuminate\Database\Seeder;

/**
 * Основные параметры (характеристики) объявлений для листовых рубрик.
 *
 * Дерево рубрик: Аренда/Продажа (level 0) -> группа (level 1) -> лист (level 2).
 * Объявления привязаны к листовым рубрикам, а форма bb/add показывает поля
 * параметров по точному rubric_id (Parameter_Rubric() в js/custom.js),
 * поэтому связи parameter_rubric создаются только для листьев.
 *
 * Один и тот же параметр (например «Год выпуска», «Мощность, кВт»)
 * переиспользуется в разных группах: у параметра может быть много рубрик,
 * дубли строк в parameters не создаются (уникальность по name+type+measure).
 *
 * Идемпотентен: повторный запуск не создаёт дублей.
 */
class ParameterSeeder extends Seeder
{
    /**
     * Наборы параметров по названию группы (level 1).
     * Группы одинаковые в ветках «Аренда» и «Продажа».
     *
     * Формат: name, type (number|year), measure, min, max, options.
     */
    private const GROUP_PARAMS = [
        'Экскаватор' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Мощность', 'type' => 'number', 'measure' => 'кВт', 'min' => 0],
            ['name' => 'Масса', 'type' => 'number', 'measure' => 'т', 'min' => 0],
            ['name' => 'Глубина копания', 'type' => 'number', 'measure' => 'м', 'min' => 0],
            ['name' => 'Объем ковша', 'type' => 'number', 'measure' => 'м³', 'min' => 0],
        ],
        'Погрузчик' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Мощность', 'type' => 'number', 'measure' => 'кВт', 'min' => 0],
            ['name' => 'Грузоподъемность', 'type' => 'number', 'measure' => 'т', 'min' => 0],
            ['name' => 'Высота подъема', 'type' => 'number', 'measure' => 'м', 'min' => 0],
            ['name' => 'Объем ковша', 'type' => 'number', 'measure' => 'м³', 'min' => 0],
        ],
        'Кран' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Грузоподъемность', 'type' => 'number', 'measure' => 'т', 'min' => 0],
            ['name' => 'Высота подъема', 'type' => 'number', 'measure' => 'м', 'min' => 0],
            ['name' => 'Вылет стрелы', 'type' => 'number', 'measure' => 'м', 'min' => 0],
        ],
        'Самосвал' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Грузоподъемность', 'type' => 'number', 'measure' => 'т', 'min' => 0],
            ['name' => 'Объем кузова', 'type' => 'number', 'measure' => 'м³', 'min' => 0],
        ],
        'Дорожно-строительная техника' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Мощность', 'type' => 'number', 'measure' => 'кВт', 'min' => 0],
            ['name' => 'Масса', 'type' => 'number', 'measure' => 'т', 'min' => 0],
        ],
        'Подъемник' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Рабочая высота', 'type' => 'number', 'measure' => 'м', 'min' => 0],
            ['name' => 'Грузоподъемность', 'type' => 'number', 'measure' => 'кг', 'min' => 0],
        ],
        'Техника для бетона' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Производительность', 'type' => 'number', 'measure' => 'м³/ч', 'min' => 0],
        ],
        'Транспортировка' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Грузоподъемность', 'type' => 'number', 'measure' => 'т', 'min' => 0],
            ['name' => 'Длина платформы', 'type' => 'number', 'measure' => 'м', 'min' => 0],
        ],
        'Инструмент' => [
            ['name' => 'Мощность', 'type' => 'number', 'measure' => 'Вт', 'min' => 0],
        ],
        'Электрогенераторы' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Мощность', 'type' => 'number', 'measure' => 'кВт', 'min' => 0],
            ['name' => 'Напряжение', 'type' => 'number', 'measure' => 'В', 'min' => 0],
        ],
        'Электротранспорт' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
            ['name' => 'Грузоподъемность', 'type' => 'number', 'measure' => 'т', 'min' => 0],
        ],
        'Другое' => [
            ['name' => 'Год выпуска', 'type' => 'year', 'min' => 1950],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // sort = позиция первого вхождения параметра в порядке перебора наборов
        $sortByKey = [];
        $parameterIdsByGroup = [];

        foreach (self::GROUP_PARAMS as $group => $definitions) {
            foreach ($definitions as $definition) {
                $measure = $definition['measure'] ?? null;
                $key = $definition['name'] . '|' . $definition['type'] . '|' . ($measure ?? '');

                if (!array_key_exists($key, $sortByKey)) {
                    $sortByKey[$key] = count($sortByKey) + 1;
                }

                $parameter = Parameter::updateOrCreate(
                    [
                        'name' => $definition['name'],
                        'type' => $definition['type'],
                        'measure' => $measure,
                    ],
                    [
                        'sort' => $sortByKey[$key],
                        'min' => $definition['min'] ?? null,
                        'max' => $definition['max'] ?? null,
                        'options' => $definition['options'] ?? null,
                    ]
                );

                $parameterIdsByGroup[$group][] = $parameter->id;
            }
        }

        // Привязываем параметры только к листовым рубрикам (низший уровень)
        $leaves = Rubric::whereDoesntHave('rubrics')->with('parent')->get();

        foreach ($leaves as $leaf) {
            $group = optional($leaf->parent)->title;

            foreach ($parameterIdsByGroup[$group] ?? [] as $parameterId) {
                ParameterRubric::updateOrCreate([
                    'rubric_id' => $leaf->id,
                    'parameter_id' => $parameterId,
                ]);
            }
        }
    }
}
