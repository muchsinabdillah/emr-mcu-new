<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SdsController extends Controller
{
    protected $answersData;
    protected $questionersData;
    protected $conclusionsData;

    /**
     * return void
     */
    public function __construct()
    {
        $this->answersData =
        [
            [ "id" => 1, "text" => "Tidak pernah menimbulkan stress.", ],
            [ "id" => 2, "text" => "Jarang sekali menimbulkan stress.", ],
            [ "id" => 3, "text" => "Jarang menimbulkan stress.", ],
            [ "id" => 4, "text" => "Kadang-kadang menimbulkan stress.", ],
            [ "id" => 5, "text" => "Sering menimbulkan stress.", ],
            [ "id" => 6, "text" => "Sering kali menimbulkan stress.", ],
            [ "id" => 7, "text" => "Selalu menimbulkan stress.", ],
        ];

        $this->questionersData =
        [
            [ "id" => 1, "text" => "Tujuan tugas-tugas dan pekerjaan saya tidak jelas?!", ],
            [ "id" => 2, "text" => "Saya mengerjakan tugas-tugas atau proyek-proyek yang tidak perlu?!", ],
            [ "id" => 3, "text" => "Saya harus membawa pulang pekerjaan ke rumah setiap sore hari atau akhir pekan agar dapat mengejar waktu?!", ],
            [ "id" => 4, "text" => "Tuntutan-tuntutan mengenai mutu pekerjaan terhadap saya keterlaluan?!", ],
            [ "id" => 5, "text" => "Saya tidak mempunyai kesempatan yang memadai untuk maju dalam organisasi ini?!", ],
            [ "id" => 6, "text" => "Saya bertanggung jawab untuk pengembangan karyawan lain?!", ],
            [ "id" => 7, "text" => "Saya tidak jelas kepada siapa harus melapor dan/atau siapa yang melapor kepada saya?!", ],
            [ "id" => 8, "text" => "Saya terjepit ditengah-tengah antara atasan dan bawahan saya?!", ],
            [ "id" => 9, "text" => "Saya menghabiskan waktu terlalu banyak untuk pertemuan-pertemuan yang tidak penting yang menyita waktu saya?!", ],
            [ "id" => 10, "text" => "Tugas-tugas yang diberikan kepada saya kadang-kadang terlalu sulit dan/atau terlalu kompleks?!", ],
            [ "id" => 11, "text" => "Kalau saya ingin naik pangkat, saya harus mencari pekerjaan pada satuan kerja lain?!", ],
            [ "id" => 12, "text" => "Saya bertanggung jawab untuk membimbing dan/atau membantu bawahan saya menyelesaikan problemnya?!", ],
            [ "id" => 13, "text" => "Saya tidak mempunyai wewenang untuk melaksanakan tanggung jawab pekerjaan saya?!", ],
            [ "id" => 14, "text" => "Jalur perintah yang formal tidak dipatuhi?!", ],
            [ "id" => 15, "text" => "Saya bertanggung jawab atas semua proyek pekerjaan dalam waktu bersamaan yang hampir tidak dapat dikendalikan?!", ],
            [ "id" => 16, "text" => "Tugas-tugas tampaknya makin hari menjadi makin kompleks?!", ],
            [ "id" => 17, "text" => "Saya merugikan kemajuan karir saya dengan menetap pada organisasi ini?!", ],
            [ "id" => 18, "text" => "Saya bertindak atau membuat keputusan-keputusan yang mempengaruhi keselamatan dan kesejahteraan orang lain?!", ],
            [ "id" => 19, "text" => "Saya tidak mengerti sepenuhnya apa yang diharapkan dari saya?!", ],
            [ "id" => 20, "text" => "Saya melakukan pekerjaan yang diterima oleh satu orang tapi tidak diterima oleh yang lain?!", ],
            [ "id" => 21, "text" => "Saya benar-benar mempunyai pekerjaan yang lebih banyak daripada yang biasanya dapat dikerjakan dalam sehari?!", ],
            [ "id" => 22, "text" => "Organisasi mengharapkan saya melebihi keterampilan dan/atau kemampuan yang saya miliki?!", ],
            [ "id" => 23, "text" => "Saya hanya mempunyai sedikit kesempatan untuk berkembang dan belajar pengetahuan dan keterampilan baru dalam pekerjaan saya?!", ],
            [ "id" => 24, "text" => "Tanggung jawab saya dalam organisasi ini lebih mengenai orang dari pada barang?!", ],
            [ "id" => 25, "text" => "Saya tidak mengerti bagian yang diperankan pekerjaan saya dalam memenuhi tujuan organisasi keseluruhan?!", ],
            [ "id" => 26, "text" => "Saya menerima permintaan-permintaan yang saling bertentangan dari satu orang atau lebih?!", ],
            [ "id" => 27, "text" => "Saya merasa bahwa saya betul-betul tidak punya waktu untuk istirahat berkala?!", ],
            [ "id" => 28, "text" => "Saya kurang terlatih dan/atau kurang pengalaman untuk melaksanakan tugas-tugas saya secara memadai?!", ],
            [ "id" => 29, "text" => "Saya merasa mandeg dalam karir saya?!", ],
            [ "id" => 30, "text" => "Saya bertanggung jawab atas hari depan (karir) orang lain?!", ],
        ];

        $this->categoriesData =
        [
            [ "id" => 1, "category" => "Ketaksaan Peran (AM)", ],
            [ "id" => 2, "category" => "Konflik Peran (CO)", ],
            [ "id" => 3, "category" => "Beban Kerja Berlebih / Kuantitatif (OQN)", ],
            [ "id" => 4, "category" => "Beban Kerja Berlebih / Kualitatif (OQl)", ],
            [ "id" => 5, "category" => "Pengembangan Karier (CD)", ],
            [ "id" => 6, "category" => "Tanggung jawab terhadap orang lain (RE)", ],
        ];

        $this->conclusionsData =
        [
            [ "id" => 1, "category_id" => 1, "questioner_id" => 1, ],
            [ "id" => 2, "category_id" => 1, "questioner_id" => 7, ],
            [ "id" => 3, "category_id" => 1, "questioner_id" => 13, ],
            [ "id" => 4, "category_id" => 1, "questioner_id" => 19, ],
            [ "id" => 5, "category_id" => 1, "questioner_id" => 25, ],

            [ "id" => 6, "category_id" => 2, "questioner_id" => 2, ],
            [ "id" => 7, "category_id" => 2, "questioner_id" => 8, ],
            [ "id" => 8, "category_id" => 2, "questioner_id" => 14, ],
            [ "id" => 9, "category_id" => 2, "questioner_id" => 20, ],
            [ "id" => 10, "category_id" => 2, "questioner_id" => 26, ],

            [ "id" => 11, "category_id" => 3, "questioner_id" => 3, ],
            [ "id" => 12, "category_id" => 3, "questioner_id" => 9, ],
            [ "id" => 13, "category_id" => 3, "questioner_id" => 15, ],
            [ "id" => 14, "category_id" => 3, "questioner_id" => 21, ],
            [ "id" => 15, "category_id" => 3, "questioner_id" => 27, ],

            [ "id" => 16, "category_id" => 4, "questioner_id" => 4, ],
            [ "id" => 17, "category_id" => 4, "questioner_id" => 10, ],
            [ "id" => 18, "category_id" => 4, "questioner_id" => 16, ],
            [ "id" => 19, "category_id" => 4, "questioner_id" => 22, ],
            [ "id" => 20, "category_id" => 4, "questioner_id" => 28, ],

            [ "id" => 21, "category_id" => 5, "questioner_id" => 5, ],
            [ "id" => 22, "category_id" => 5, "questioner_id" => 11, ],
            [ "id" => 23, "category_id" => 5, "questioner_id" => 17, ],
            [ "id" => 24, "category_id" => 5, "questioner_id" => 23, ],
            [ "id" => 25, "category_id" => 5, "questioner_id" => 29, ],

            [ "id" => 26, "category_id" => 6, "questioner_id" => 6, ],
            [ "id" => 27, "category_id" => 6, "questioner_id" => 12, ],
            [ "id" => 28, "category_id" => 6, "questioner_id" => 18, ],
            [ "id" => 29, "category_id" => 6, "questioner_id" => 24, ],
            [ "id" => 30, "category_id" => 6, "questioner_id" => 30, ],
        ];
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        return view("sds.auth");
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $validated = Validator::make($request->input(), [

            "fullname" => "required|string",
            "birthdate" => "required|date",
            'captcha' => 'required|captcha',

        ])->validate();

        return redirect()->route("faq.index");
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("sds.faq",
        [
            "answers" => $this->answersData,
            "questioners" => $this->questionersData,
        ]);
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answers = collect($this->answersData);
        $questioners = collect($this->questionersData);
        $categories = collect($this->categoriesData);
        $conclusions = collect($this->conclusionsData);

        $validated = collect(Validator::make($request->input(), [

            "faq" => "required|array",
            "faq.*" => "required|integer|digits_between:1,7",

        ])->validate()["faq"])->mapWithKeys(function ($value, $key) use ($answers, $questioners, $categories, $conclusions) {

            $answerId = (int) $value;
            $questionerId = $key + 1;
            $categoryId = $conclusions->firstWhere("questioner_id", $questionerId)['category_id'];

            return [ $key =>
            [
                "questioner_id" => $questionerId,
                "questioner" => $questioners->firstWhere("id", $questionerId),
                "answer_id" => $answerId,
                "answer" => $answers->firstWhere("id", $answerId),
                "category_id" => $categoryId,
                "category" => $categories->firstWhere("id", $categoryId),

            ], ];

        })->groupBy("category_id")->map(function ($value, $key) use ($categories) {

            $total = $value->sum("answer_id");
            $grade = "";

            if ($total <= 9) $grade = "RINGAN";
            else if ($total >= 10 && $total <= 24) $grade = "SEDANG";
            else if ($total >= 25) $grade = "BERAT";

            return [

                "category" => $categories->firstWhere("id", $key),
                "total" => $total,
                "grade" => $grade,
            ];
        });

        return back()->with("results", $validated);
    }
};
