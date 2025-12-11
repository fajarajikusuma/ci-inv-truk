<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $kendaraan_simpan;
    public $kendaraan_edit;
    public $sopir_simpan;
    public $sopir_edit;
    public $user_simpan;
    public $user_edit;
    public $login;
    public $pemeliharaan_simpan;
    public $pemeliharaan_edit;

    public function __construct()
    {
        $tahunSekarang = date('Y');

        $this->kendaraan_simpan = [
            'nopol' => 'required|min_length[5]|is_unique[tb_kendaraan.nopol]',
            'jenis' => 'required',
            'merk'  => 'required',
            'tipe'  => 'required',
            'tahun' => "required|integer|greater_than_equal_to[1960]|less_than_equal_to[{$tahunSekarang}]",
            'no_rangka' => 'required|is_unique[tb_kendaraan.no_rangka]',
            'no_mesin' => 'required|is_unique[tb_kendaraan.no_mesin]',
            'foto' => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            'status' => 'required',
        ];

        $this->kendaraan_edit = [
            'nopol' => 'required|min_length[6]',
            'jenis' => 'required',
            'merk'  => 'required',
            'tipe'  => 'required',
            'tahun' => "required|integer|greater_than_equal_to[1960]|less_than_equal_to[{$tahunSekarang}]",
            'no_rangka' => 'required',
            'no_mesin' => 'required',
            'foto' => 'permit_empty|is_image[foto]|max_size[foto,2048]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            'status' => 'required',
        ];

        $this->sopir_simpan = [
            'nama_sopir' => 'required',
            'no_hp' => 'required|min_length[10]|max_length[13]',
            'status' => 'required',
        ];

        $this->sopir_edit = [
            'nama_sopir' => 'required',
            'no_hp' => 'required|min_length[10]|max_length[13]',
            'status' => 'required',
        ];

        $this->user_simpan = [
            'nama' => 'required',
            'username' => 'required|min_length[5]|is_unique[tb_user.username]',
            'password' => 'required|min_length[8]',
            'role' => 'required',
            'status' => 'required',
        ];

        $this->user_edit = [
            'nama' => 'required',
            'username' => 'permit_empty|min_length[5]',
            'password' => 'permit_empty|min_length[8]',
            'role' => 'required',
            'status' => 'required',
        ];

        $this->login = [
            'username' => 'required',
            'password' => 'required',
        ];

        $this->pemeliharaan_simpan = [
            'bengkel' => 'required',
            'tindakan_perbaikan' => 'required',
            'biaya' => 'required|integer',
            'nota' => 'permit_empty|uploaded[nota]|is_image[nota]|max_size[nota,2048]|mime_in[nota,image/jpg,image/jpeg,image/png]',
        ];

        $this->pemeliharaan_edit = [
            'bengkel' => 'required',
            'tindakan_perbaikan' => 'required',
            'biaya' => 'required',
            'nota' => 'permit_empty|uploaded[nota]|is_image[nota]|max_size[nota,2048]|mime_in[nota,image/jpg,image/jpeg,image/png]',
        ];
    }
}
