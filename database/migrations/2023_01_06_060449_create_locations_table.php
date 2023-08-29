<?php

use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->string('title_r',100);
            $table->string('lat',100)->nullable();
            $table->string('lng',100)->nullable();

            //$table->unsignedBigInteger('parent_id')->nullable();
            //$table->foreign('parent_id')->references('id')->on('locations')->onDelete('restrict');
            $table->unsignedBigInteger('sort')->default(500);
            $table->nestedSet();
            $table->unsignedBigInteger('level')->nullable();
            $table->timestamps();
        });

        $id_1 = Location::create(['id'=>1,'title' => 'Брестская область','title_r' => 'Брестской области','parent_id' => 0,'level' => 0,'lat'=>'52.5296641','lng'=>'25.4606480']);
        $id_2 = Location::create(['id'=>2,'title' => 'Витебская область','title_r' => 'Витебской области','parent_id' => 0,'level' => 0,'lat'=>'55.2959833','lng'=>'28.7583626']);
        $id_3 = Location::create(['id'=>3,'title' => 'Гомельская область','title_r' => 'Гомельской области','parent_id' => 0,'level' => 0,'lat'=>'52.1648754','lng'=>'29.1333251']);
        $id_4 = Location::create(['id'=>4,'title' => 'Гродненская область','title_r' => 'Гродненской области','parent_id' => 0,'level' => 0,'lat'=>'53.6599945','lng'=>'25.3448570']);
        $id_5 = Location::create(['id'=>5,'title' => 'Минская область','title_r' => 'Минской области','parent_id' => 0,'level' => 0,'lat'=>'53.4718561','lng'=>'27.6969909']);
        $id_6 = Location::create(['id'=>6,'title' => 'Могилевская область','title_r' => 'Могилевской области','parent_id' => 0,'level' => 0,'lat'=>'53.7940401','lng'=>'30.7519767']);
        $id_7 = Location::create(['id'=>7,'title' => 'Брест','title_r' => 'Бресте','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.0976214','lng'=>'23.7340503']);
        $id_8 = Location::create(['id'=>8,'title' => 'Витебск','title_r' => 'Витебске','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.1848061','lng'=>'30.2016220']);
        $id_9 = Location::create(['id'=>9,'title' => 'Гомель','title_r' => 'Гомеле','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.4411761','lng'=>'30.9878462']);
        $id_10 = Location::create(['id'=>10,'title' => 'Гродно','title_r' => 'Гродно','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.6693538','lng'=>'23.8131306']);
        $id_11 = Location::create(['id'=>11,'title' => 'Могилев','title_r' => 'Могилеве','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.9007159','lng'=>'30.3313598']);
        $id_12 = Location::create(['id'=>12,'title' => 'Минск','title_r' => 'Минске','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.9045398','lng'=>'27.5615244']);
        $id_13 = Location::create(['id'=>13,'title' => 'Барановичи','title_r' => 'Барановичах','parent_id' => $id_1->id,'level' => 1,'lat'=>'53.1255737','lng'=>'26.0091683']);
        $id_14 = Location::create(['id'=>14,'title' => 'Пинск','title_r' => 'Пинске','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.1124967','lng'=>'26.0634602']);
        $id_15 = Location::create(['id'=>15,'title' => 'Кобрин','title_r' => 'Кобрине','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.2141109','lng'=>'24.3581792']);
        $id_16 = Location::create(['id'=>16,'title' => 'Береза','title_r' => 'Березе','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.5373125','lng'=>'24.9788566']);
        $id_17 = Location::create(['id'=>17,'title' => 'Ивацевичи','title_r' => 'Ивацевичах','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.7085795','lng'=>'25.3346543']);
        $id_18 = Location::create(['id'=>18,'title' => 'Лунинец','title_r' => 'Лунинце','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.2513941','lng'=>'26.8066432']);
        $id_19 = Location::create(['id'=>19,'title' => 'Пружаны','title_r' => 'Пружанах','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.5557638','lng'=>'24.4554645']);
        $id_20 = Location::create(['id'=>20,'title' => 'Иваново','title_r' => 'Иваново','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.1458870','lng'=>'25.5329454']);
        $id_21 = Location::create(['id'=>21,'title' => 'Дрогичин','title_r' => 'Дрогичине','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.1930413','lng'=>'25.1471719']);
        $id_22 = Location::create(['id'=>22,'title' => 'Ганцевичи','title_r' => 'Ганцевичах','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.7634482','lng'=>'26.4275001']);
        $id_23 = Location::create(['id'=>23,'title' => 'Микашевичи','title_r' => 'Микашевичах','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.2160531','lng'=>'27.4751997']);
        $id_24 = Location::create(['id'=>24,'title' => 'Белоозерск','title_r' => 'Белоозерске','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.4717355','lng'=>'25.1783133']);
        $id_25 = Location::create(['id'=>25,'title' => 'Жабинка','title_r' => 'Жабинке','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.1954738','lng'=>'24.0149350']);
        $id_26 = Location::create(['id'=>26,'title' => 'Столин','title_r' => 'Столине','parent_id' => $id_1->id,'level' => 1,'lat'=>'51.8873063','lng'=>'26.8394148']);
        $id_27 = Location::create(['id'=>27,'title' => 'Ляховичи','title_r' => 'Ляховичах','parent_id' => $id_1->id,'level' => 1,'lat'=>'53.0399358','lng'=>'26.2614947']);
        $id_28 = Location::create(['id'=>28,'title' => 'Малорита','title_r' => 'Малорите','parent_id' => $id_1->id,'level' => 1,'lat'=>'51.7925615','lng'=>'24.0739629']);
        $id_29 = Location::create(['id'=>29,'title' => 'Каменец','title_r' => 'Каменце','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.3979454','lng'=>'23.8257811']);
        $id_30 = Location::create(['id'=>30,'title' => 'Давид-Городок','title_r' => 'Давид-Городке','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.0546671','lng'=>'27.2119237']);
        $id_31 = Location::create(['id'=>31,'title' => 'Речица','title_r' => 'Речице','parent_id' => $id_1->id,'level' => 1,'lat'=>'51.8586496','lng'=>'26.7862240']);
        $id_32 = Location::create(['id'=>32,'title' => 'Высокое','title_r' => 'Высоком','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.3679780','lng'=>'23.3759718']);
        $id_33 = Location::create(['id'=>33,'title' => 'Телеханы','title_r' => 'Телеханах','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.5177818','lng'=>'25.8443730']);
        $id_34 = Location::create(['id'=>34,'title' => 'Ружаны','title_r' => 'Ружанах','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.8669497','lng'=>'24.8920219']);
        $id_35 = Location::create(['id'=>35,'title' => 'Логишин','title_r' => 'Логишине','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.3359637','lng'=>'25.9862701']);
        $id_36 = Location::create(['id'=>36,'title' => 'Городище','title_r' => 'Городище','parent_id' => $id_1->id,'level' => 1,'lat'=>'53.3269782','lng'=>'26.0063136']);
        $id_37 = Location::create(['id'=>37,'title' => 'Коссово','title_r' => 'Коссово','parent_id' => $id_1->id,'level' => 1,'lat'=>'52.7567887','lng'=>'25.1531057']);
        $id_38 = Location::create(['id'=>38,'title' => 'Орша','title_r' => 'Орше','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.5071478','lng'=>'30.4119546']);
        $id_39 = Location::create(['id'=>39,'title' => 'Новополоцк','title_r' => 'Новополоцке','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.5146432','lng'=>'28.5606439']);
        $id_40 = Location::create(['id'=>40,'title' => 'Полоцк','title_r' => 'Полоцке','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.4831573','lng'=>'28.7990619']);
        $id_41 = Location::create(['id'=>41,'title' => 'Поставы','title_r' => 'Поставах','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.1134117','lng'=>'26.8433286']);
        $id_42 = Location::create(['id'=>42,'title' => 'Глубокое','title_r' => 'Глубоком','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.1391321','lng'=>'27.6842904']);
        $id_43 = Location::create(['id'=>43,'title' => 'Лепель','title_r' => 'Лепеле','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.8781790','lng'=>'28.6980563']);
        $id_44 = Location::create(['id'=>44,'title' => 'Новолукомль','title_r' => 'Новолукомле','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.6575917','lng'=>'29.1509792']);
        $id_45 = Location::create(['id'=>45,'title' => 'Городок','title_r' => 'Городке','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.4618616','lng'=>'29.9874438']);
        $id_46 = Location::create(['id'=>46,'title' => 'Барань','title_r' => 'Барани','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.4788881','lng'=>'30.3160067']);
        $id_47 = Location::create(['id'=>47,'title' => 'Толочин','title_r' => 'Толочине','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.4098787','lng'=>'29.6935064']);
        $id_48 = Location::create(['id'=>48,'title' => 'Браслав','title_r' => 'Браславе','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.6411645','lng'=>'27.0450814']);
        $id_49 = Location::create(['id'=>49,'title' => 'Чашники','title_r' => 'Чашниках','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.8478130','lng'=>'29.1730691']);
        $id_50 = Location::create(['id'=>50,'title' => 'Дубровно','title_r' => 'Дубровно','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.5734035','lng'=>'30.6828298']);
        $id_51 = Location::create(['id'=>51,'title' => 'Миоры','title_r' => 'Миорах','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.6226563','lng'=>'27.6334350']);
        $id_52 = Location::create(['id'=>52,'title' => 'Сенно','title_r' => 'Сенно','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.8133814','lng'=>'29.7063314']);
        $id_53 = Location::create(['id'=>53,'title' => 'Бешенковичи','title_r' => 'Бешенковичах','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.0444134','lng'=>'29.4559263']);
        $id_54 = Location::create(['id'=>54,'title' => 'Верхнедвинск','title_r' => 'Верхнедвинске','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.7784607','lng'=>'27.9323817']);
        $id_55 = Location::create(['id'=>55,'title' => 'Руба','title_r' => 'Рубе','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.2956230','lng'=>'30.3046696']);
        $id_56 = Location::create(['id'=>56,'title' => 'Шумилино','title_r' => 'Шумилино','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.3000777','lng'=>'29.6112895']);
        $id_57 = Location::create(['id'=>57,'title' => 'Шарковщина','title_r' => 'Шарковщине','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.3682716','lng'=>'27.4703402']);
        $id_58 = Location::create(['id'=>58,'title' => 'Докшицы','title_r' => 'Докшицах','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.8953858','lng'=>'27.7599272']);
        $id_59 = Location::create(['id'=>59,'title' => 'Лиозно','title_r' => 'Лиозно','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.0241450','lng'=>'30.8005553']);
        $id_60 = Location::create(['id'=>60,'title' => 'Ушачи','title_r' => 'Ушачах','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.1786995','lng'=>'28.6159394']);
        $id_61 = Location::create(['id'=>61,'title' => 'Россоны','title_r' => 'Россонах','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.9014488','lng'=>'28.8200362']);
        $id_62 = Location::create(['id'=>62,'title' => 'Боровуха','title_r' => 'Боровухе','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.5796966','lng'=>'28.6665799']);
        $id_63 = Location::create(['id'=>63,'title' => 'Коханово','title_r' => 'Коханово','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.4626821','lng'=>'30.0025887']);
        $id_64 = Location::create(['id'=>64,'title' => 'Болбасово','title_r' => 'Болбасово','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.4204981','lng'=>'30.2877980']);
        $id_65 = Location::create(['id'=>65,'title' => 'Богушевск','title_r' => 'Богушевске','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.8420473','lng'=>'30.2064824']);
        $id_66 = Location::create(['id'=>66,'title' => 'Ореховск','title_r' => 'Ореховске','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.6838383','lng'=>'30.4942223']);
        $id_67 = Location::create(['id'=>67,'title' => 'Воропаево','title_r' => 'Воропаево','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.1390249','lng'=>'27.2066843']);
        $id_68 = Location::create(['id'=>68,'title' => 'Оболь','title_r' => 'Оболе','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.3520232','lng'=>'29.2998728']);
        $id_69 = Location::create(['id'=>69,'title' => 'Бегомль','title_r' => 'Бегомле','parent_id' => $id_2->id,'level' => 1,'lat'=>'54.7318321','lng'=>'28.0605962']);
        $id_70 = Location::create(['id'=>70,'title' => 'Ветрино','title_r' => 'Ветрино','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.4104842','lng'=>'28.4633425']);
        $id_71 = Location::create(['id'=>71,'title' => 'Подсвилье','title_r' => 'Подсвилье','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.1462960','lng'=>'27.9643681']);
        $id_72 = Location::create(['id'=>72,'title' => 'Дисна','title_r' => 'Дисне','parent_id' => $id_2->id,'level' => 1,'lat'=>'55.5662814','lng'=>'28.2137745']);
        $id_73 = Location::create(['id'=>73,'title' => 'Мозырь','title_r' => 'Мозыре','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.0322082','lng'=>'29.2223129']);
        $id_74 = Location::create(['id'=>74,'title' => 'Светлогорск','title_r' => 'Светлогорске','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.6266995','lng'=>'29.7490257']);
        $id_75 = Location::create(['id'=>75,'title' => 'Жлобин','title_r' => 'Жлобине','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.8888952','lng'=>'30.0282481']);
        $id_76 = Location::create(['id'=>76,'title' => 'Речица','title_r' => 'Речице','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.3635403','lng'=>'30.3923965']);
        $id_77 = Location::create(['id'=>77,'title' => 'Калинковичи','title_r' => 'Калинковичах','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.1253899','lng'=>'29.3297633']);
        $id_78 = Location::create(['id'=>78,'title' => 'Рогачев','title_r' => 'Рогачеве','parent_id' => $id_3->id,'level' => 1,'lat'=>'53.0918554','lng'=>'30.0503982']);
        $id_79 = Location::create(['id'=>79,'title' => 'Добруш','title_r' => 'Добруше','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.4031652','lng'=>'31.3294618']);
        $id_80 = Location::create(['id'=>80,'title' => 'Житковичи','title_r' => 'Житковичах','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.2160819','lng'=>'27.8502774']);
        $id_81 = Location::create(['id'=>81,'title' => 'Хойники','title_r' => 'Хойниках','parent_id' => $id_3->id,'level' => 1,'lat'=>'51.9109552','lng'=>'29.9994415']);
        $id_82 = Location::create(['id'=>82,'title' => 'Петриков','title_r' => 'Петрикове','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.1267722','lng'=>'28.4919521']);
        $id_83 = Location::create(['id'=>83,'title' => 'Костюковка','title_r' => 'Костюковке','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.5358998','lng'=>'30.9147813']);
        $id_84 = Location::create(['id'=>84,'title' => 'Ельск','title_r' => 'Ельске','parent_id' => $id_3->id,'level' => 1,'lat'=>'51.8137357','lng'=>'29.1596054']);
        $id_85 = Location::create(['id'=>85,'title' => 'Буда-Кошелево','title_r' => 'Буда-Кошелево','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.7201592','lng'=>'30.5692250']);
        $id_86 = Location::create(['id'=>86,'title' => 'Лельчицы','title_r' => 'Лельчицах','parent_id' => $id_3->id,'level' => 1,'lat'=>'51.7959101','lng'=>'28.3296165']);
        $id_87 = Location::create(['id'=>87,'title' => 'Октябрьский','title_r' => 'Октябрьском','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.6473109','lng'=>'28.8851644']);
        $id_88 = Location::create(['id'=>88,'title' => 'Наровля','title_r' => 'Наровле','parent_id' => $id_3->id,'level' => 1,'lat'=>'51.8010382','lng'=>'29.4967759']);
        $id_89 = Location::create(['id'=>89,'title' => 'Ветка','title_r' => 'Ветке','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.5662086','lng'=>'31.1730798']);
        $id_90 = Location::create(['id'=>90,'title' => 'Чечерск','title_r' => 'Чечерске','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.9186475','lng'=>'30.9162800']);
        $id_91 = Location::create(['id'=>91,'title' => 'Лоев','title_r' => 'Лоеве','parent_id' => $id_3->id,'level' => 1,'lat'=>'51.9377873','lng'=>'30.7892014']);
        $id_92 = Location::create(['id'=>92,'title' => 'Корма','title_r' => 'Корме','parent_id' => $id_3->id,'level' => 1,'lat'=>'53.1307962','lng'=>'30.7935909']);
        $id_93 = Location::create(['id'=>93,'title' => 'Василевичи','title_r' => 'Василевичах','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.2443711','lng'=>'29.8315009']);
        $id_94 = Location::create(['id'=>94,'title' => 'Копаткевичи','title_r' => 'Копаткевичах','parent_id' => $id_3->id,'level' => 1,'lat'=>'','lng'=>'']);
        $id_95 = Location::create(['id'=>95,'title' => 'Брагин','title_r' => 'Брагине','parent_id' => $id_3->id,'level' => 1,'lat'=>'51.7954009','lng'=>'30.2688788']);
        $id_96 = Location::create(['id'=>96,'title' => 'Туров','title_r' => 'Турове','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.0663389','lng'=>'27.7405067']);
        $id_97 = Location::create(['id'=>97,'title' => 'Уваровичи','title_r' => 'Уваровичах','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.5958104','lng'=>'30.7272291']);
        $id_98 = Location::create(['id'=>98,'title' => 'Паричи','title_r' => 'Паричах','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.8103714','lng'=>'29.4103055']);
        $id_99 = Location::create(['id'=>99,'title' => 'Сосновый Бор','title_r' => 'Сосновом Бору','parent_id' => $id_3->id,'level' => 1,'lat'=>'52.5177754','lng'=>'29.5970434']);
        $id_100 = Location::create(['id'=>100,'title' => 'Лида','title_r' => 'Лиде','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.8873843','lng'=>'25.2894383']);
        $id_101 = Location::create(['id'=>101,'title' => 'Слоним','title_r' => 'Слониме','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.0875127','lng'=>'25.3087192']);
        $id_102 = Location::create(['id'=>102,'title' => 'Волковыск','title_r' => 'Волковыске','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.1516417','lng'=>'24.4422029']);
        $id_103 = Location::create(['id'=>103,'title' => 'Сморгонь','title_r' => 'Сморгони','parent_id' => $id_4->id,'level' => 1,'lat'=>'54.4762327','lng'=>'26.3981493']);
        $id_104 = Location::create(['id'=>104,'title' => 'Новогрудок','title_r' => 'Новогрудке','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.5977360','lng'=>'25.8243706']);
        $id_105 = Location::create(['id'=>105,'title' => 'Мосты','title_r' => 'Мостах','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.4102363','lng'=>'24.5338654']);
        $id_106 = Location::create(['id'=>106,'title' => 'Щучин','title_r' => 'Щучине','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.6040518','lng'=>'24.7418990']);
        $id_107 = Location::create(['id'=>107,'title' => 'Ошмяны','title_r' => 'Ошмянах','parent_id' => $id_4->id,'level' => 1,'lat'=>'54.4243464','lng'=>'25.9351597']);
        $id_108 = Location::create(['id'=>108,'title' => 'Березовка','title_r' => 'Березовке','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.7221715','lng'=>'25.5004738']);
        $id_109 = Location::create(['id'=>109,'title' => 'Скидель','title_r' => 'Скиделе','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.5866599','lng'=>'24.2503492']);
        $id_110 = Location::create(['id'=>110,'title' => 'Ивье','title_r' => 'Ивье','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.9323017','lng'=>'25.7774860']);
        $id_111 = Location::create(['id'=>111,'title' => 'Островец','title_r' => 'Островце','parent_id' => $id_4->id,'level' => 1,'lat'=>'54.6105209','lng'=>'25.9524709']);
        $id_112 = Location::create(['id'=>112,'title' => 'Дятлово','title_r' => 'Дятлово','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.4651358','lng'=>'25.4074899']);
        $id_113 = Location::create(['id'=>113,'title' => 'Зельва','title_r' => 'Зельве','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.1501463','lng'=>'24.8029785']);
        $id_114 = Location::create(['id'=>114,'title' => 'Кореличи','title_r' => 'Кореличах','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.5666638','lng'=>'26.1406893']);
        $id_115 = Location::create(['id'=>115,'title' => 'Свислочь','title_r' => 'Свислочи','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.0358086','lng'=>'24.0942728']);
        $id_116 = Location::create(['id'=>116,'title' => 'Красносельский','title_r' => 'Красносельском','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.2621830','lng'=>'24.4235742']);
        $id_117 = Location::create(['id'=>117,'title' => ' Вороново','title_r' => 'Вороново','parent_id' => $id_4->id,'level' => 1,'lat'=>'54.1499032','lng'=>'25.3160274']);
        $id_118 = Location::create(['id'=>118,'title' => 'Россь','title_r' => 'Росси','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.2833165','lng'=>'24.4054988']);
        $id_119 = Location::create(['id'=>119,'title' => 'Большая Берестовица','title_r' => 'Большой Берестовице','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.1948656','lng'=>'24.0191604']);
        $id_120 = Location::create(['id'=>120,'title' => 'Свислочь','title_r' => 'Свислочи','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.0358086','lng'=>'24.0942728']);
        $id_121 = Location::create(['id'=>121,'title' => 'Новоельня','title_r' => 'Новоельне','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.4589973','lng'=>'25.5794614']);
        $id_122 = Location::create(['id'=>122,'title' => 'Радунь','title_r' => 'Радуни','parent_id' => $id_4->id,'level' => 1,'lat'=>'54.0481873','lng'=>'24.9974855']);
        $id_123 = Location::create(['id'=>123,'title' => 'Мир','title_r' => 'Мире','parent_id' => $id_4->id,'level' => 1,'lat'=>'53.4539951','lng'=>'26.4698363']);
        $id_124 = Location::create(['id'=>124,'title' => 'Борисов','title_r' => 'Борисове','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.2144309','lng'=>'28.5084360']);
        $id_125 = Location::create(['id'=>125,'title' => 'Солигорск','title_r' => 'Солигорске','parent_id' => $id_5->id,'level' => 1,'lat'=>'52.7899466','lng'=>'27.5359618']);
        $id_126 = Location::create(['id'=>126,'title' => 'Молодечно','title_r' => 'Молодечно','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.3104099','lng'=>'26.8488824']);
        $id_127 = Location::create(['id'=>127,'title' => 'Слуцк','title_r' => 'Слуцке','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.0210495','lng'=>'27.5540131']);
        $id_128 = Location::create(['id'=>128,'title' => 'Жодино','title_r' => 'Жодино','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.1016136','lng'=>'28.3471258']);
        $id_129 = Location::create(['id'=>129,'title' => 'Вилейка','title_r' => 'Вилейке','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.4980119','lng'=>'26.9200749']);
        $id_130 = Location::create(['id'=>130,'title' => 'Держинск','title_r' => 'Держинске','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.4949129','lng'=>'28.1496198']);
        $id_131 = Location::create(['id'=>131,'title' => 'Марьина Горка','title_r' => 'Марьиной Горке','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.5067610','lng'=>'28.1527803']);
        $id_133 = Location::create(['id'=>133,'title' => 'Несвиж','title_r' => 'Несвиже','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.2226038','lng'=>'26.6766138']);
        $id_134 = Location::create(['id'=>134,'title' => 'Смолевичи','title_r' => 'Смолевичах','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.0297214','lng'=>'28.0892299']);
        $id_135 = Location::create(['id'=>135,'title' => 'Березино','title_r' => 'Березино','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.8446885','lng'=>'28.9892933']);
        $id_136 = Location::create(['id'=>136,'title' => 'Заславль','title_r' => 'Заславле','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.0006143','lng'=>'27.2768410']);
        $id_137 = Location::create(['id'=>137,'title' => 'Старые Дороги','title_r' => 'Старых Дорогах','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.0389897','lng'=>'28.2605496']);
        $id_138 = Location::create(['id'=>138,'title' => 'Любань','title_r' => 'Любани','parent_id' => $id_5->id,'level' => 1,'lat'=>'52.7990255','lng'=>'27.9918895']);
        $id_139 = Location::create(['id'=>139,'title' => 'Фаниполь','title_r' => 'Фаниполе','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.7462380','lng'=>'27.3375641']);
        $id_140 = Location::create(['id'=>140,'title' => 'Воложин','title_r' => 'Воложине','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.0878914','lng'=>'26.5331090']);
        $id_141 = Location::create(['id'=>141,'title' => 'Клецк','title_r' => 'Клецке','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.0637214','lng'=>'26.6392615']);
        $id_142 = Location::create(['id'=>142,'title' => 'Копыль','title_r' => 'Копыли','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.1511461','lng'=>'27.0908004']);
        $id_143 = Location::create(['id'=>143,'title' => 'Червень','title_r' => 'Червене','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.7117479','lng'=>'28.4244728']);
        $id_144 = Location::create(['id'=>144,'title' => 'Логойск','title_r' => 'Логойске','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.2042169','lng'=>'27.8532022']);
        $id_145 = Location::create(['id'=>145,'title' => 'Узда','title_r' => 'Узде','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.4619521','lng'=>'27.2150890']);
        $id_146 = Location::create(['id'=>146,'title' => 'Крупки','title_r' => 'Крупках','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.3269605','lng'=>'29.1426031']);
        $id_147 = Location::create(['id'=>147,'title' => 'Плещеницы','title_r' => 'Плещеницах','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.4225141','lng'=>'27.8338499']);
        $id_148 = Location::create(['id'=>148,'title' => 'Мядель','title_r' => 'Мяделе','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.8792774','lng'=>'26.9401343']);
        $id_149 = Location::create(['id'=>149,'title' => 'Мачулищи','title_r' => 'Мачулищах','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.7741001','lng'=>'27.5912438']);
        $id_150 = Location::create(['id'=>150,'title' => 'Старобин','title_r' => 'Старобине','parent_id' => $id_5->id,'level' => 1,'lat'=>'52.7312889','lng'=>'27.4572059']);
        $id_151 = Location::create(['id'=>151,'title' => 'Радошковичи','title_r' => 'Радошковичах ','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.1571080','lng'=>'27.2318325']);
        $id_152 = Location::create(['id'=>152,'title' => 'Смиловичи','title_r' => 'Смиловичах','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.7532734','lng'=>'28.0135008']);
        $id_153 = Location::create(['id'=>153,'title' => 'Ивенец','title_r' => 'Ивенце','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.8882122','lng'=>'26.7405467']);
        $id_154 = Location::create(['id'=>154,'title' => 'Красная Слобода','title_r' => 'Красной Слободе','parent_id' => $id_5->id,'level' => 1,'lat'=>'52.8539409','lng'=>'27.1735667']);
        $id_155 = Location::create(['id'=>155,'title' => 'Городея','title_r' => 'Городее','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.3118876','lng'=>'26.5297870']);
        $id_156 = Location::create(['id'=>156,'title' => 'Уречье','title_r' => 'Уречье','parent_id' => $id_5->id,'level' => 1,'lat'=>'52.9520735','lng'=>'27.8819494']);
        $id_157 = Location::create(['id'=>157,'title' => 'Нарочь','title_r' => 'Нарочи','parent_id' => $id_5->id,'level' => 1,'lat'=>'54.8524020','lng'=>'26.7758952']);
        $id_158 = Location::create(['id'=>158,'title' => 'Руденск','title_r' => 'Руденске','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.5977081','lng'=>'27.8611129']);
        $id_159 = Location::create(['id'=>159,'title' => 'Правдинский','title_r' => 'Правдинском','parent_id' => $id_5->id,'level' => 1,'lat'=>'53.5234017','lng'=>'27.8299056']);
        $id_160 = Location::create(['id'=>160,'title' => 'Бобруйск','title_r' => 'Бобруйске','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.1446069','lng'=>'29.2213753']);
        $id_161 = Location::create(['id'=>161,'title' => 'Осиповичи','title_r' => 'Осиповичах','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.3048792','lng'=>'28.6357281']);
        $id_162 = Location::create(['id'=>162,'title' => 'Горки','title_r' => 'Горках','parent_id' => $id_6->id,'level' => 1,'lat'=>'54.2825201','lng'=>'30.9904490']);
        $id_163 = Location::create(['id'=>163,'title' => 'Кричев','title_r' => 'Кричеве','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.7093085','lng'=>'31.7171895']);
        $id_164 = Location::create(['id'=>164,'title' => 'Быхов','title_r' => 'Быхове','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.5180441','lng'=>'30.2402914']);
        $id_165 = Location::create(['id'=>165,'title' => 'Костюковичи','title_r' => 'Костюковичах','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.3449659','lng'=>'32.0532332']);
        $id_166 = Location::create(['id'=>166,'title' => 'Климовичи','title_r' => 'Климовичах','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.6091856','lng'=>'31.9594674']);
        $id_167 = Location::create(['id'=>167,'title' => 'Шклов','title_r' => 'Шклове','parent_id' => $id_6->id,'level' => 1,'lat'=>'54.2023958','lng'=>'30.2955436']);
        $id_168 = Location::create(['id'=>168,'title' => 'Мстиславль','title_r' => 'Мстиславле','parent_id' => $id_6->id,'level' => 1,'lat'=>'54.0188307','lng'=>'31.7244374']);
        $id_169 = Location::create(['id'=>169,'title' => 'Белыничи','title_r' => 'Белыничах','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.9969111','lng'=>'29.7076950']);
        $id_170 = Location::create(['id'=>170,'title' => 'Чаусы','title_r' => 'Чаусах','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.8017532','lng'=>'30.9533970']);
        $id_171 = Location::create(['id'=>171,'title' => 'Кировск','title_r' => 'Кировске','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.2691975','lng'=>'29.4765176']);
        $id_172 = Location::create(['id'=>172,'title' => 'Чериков','title_r' => 'Черикове','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.5696940','lng'=>'31.3797300']);
        $id_173 = Location::create(['id'=>173,'title' => 'Глуск','title_r' => 'Глуске','parent_id' => $id_6->id,'level' => 1,'lat'=>'52.8996249','lng'=>'28.6709271']);
        $id_174 = Location::create(['id'=>174,'title' => 'Славгород','title_r' => 'Славгороде','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.4431223','lng'=>'30.9995629']);
        $id_175 = Location::create(['id'=>175,'title' => 'Кличев','title_r' => 'Кличеве','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.4917756','lng'=>'29.3327583']);
        $id_176 = Location::create(['id'=>176,'title' => 'Круглое','title_r' => 'Круглом','parent_id' => $id_6->id,'level' => 1,'lat'=>'54.2483092','lng'=>'29.7962860']);
        $id_177 = Location::create(['id'=>177,'title' => 'Хотимск','title_r' => 'Хотимске','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.4099308','lng'=>'32.5773652']);
        $id_178 = Location::create(['id'=>178,'title' => 'Краснополье','title_r' => 'Краснополье','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.3383537','lng'=>'31.3972255']);
        $id_179 = Location::create(['id'=>179,'title' => 'Дрибин','title_r' => 'Дрибине','parent_id' => $id_6->id,'level' => 1,'lat'=>'54.1190657','lng'=>'31.1014303']);
        $id_180 = Location::create(['id'=>180,'title' => 'Елизово','title_r' => 'Елизово','parent_id' => $id_6->id,'level' => 1,'lat'=>'53.3975307','lng'=>'29.0037835']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
