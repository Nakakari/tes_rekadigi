<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatan')->insert(
            [
                'judul' => 'Mengangkat Potensi UMKM yang Ada di Desa Jatisari',
                'deskripsi' => 'Desa Wringintelu terkenal sebagai desa agraris, potensi sumber daya alam yang masih asri di desa tersebut. Mata pencaharian masyarakat desa ini yaitu berprofesi sebagai petani. Oleh karena itu, perekonomian utama di Desa Wringintelu ini masih di bidang pertanian. Selain itu, terdapat potensi lain yang mungkin bisa dikembangkan yaitu pada bidang kewirausahaan. Berdasarkan survey lokasi oleh mahasiswa KKN Kolaboratif kelompok 25 selama masa pengabdian ini, menemukan beberapa UMKM kecil dengan berbagai macam jenis bidang usaha. Hal tersebut dinilai dapat menjadi potensi penyokong perekonomian desa jika dikembangkan dengan baik.
                Berkaitan dengan hal tersebut, mahasiswa berniat untuk membantu dalam pengembangan UMKM yang ada di Desa Wringintelu. Pengembangan yang dilakukan berfokus pada perizinan peredaran produk (PIRT). Selama survey, hampir semua UMKM disini masih belum memiliki izin peredaran untuk produk hasil usahanya. Salah satu program kerja yang dilakukan oleh mahasiswa KKN Kolaboratif kelompok 25 ini akan mengangkat tentang tematik kewirausahaan dengan membantu pengembangan potensi UMKM di desa ini. Upaya tersebut dilakukan dengan mengadakan kegiatan sosialisasi terkait perizinan PIRT (Pangan Industri Rumah Tangga) berdasarkan Peraturan Badan Pengawas Obat dan Makanan (BPOM) Nomor 22 Tahun 2018 tentang pedoman pemberian sertifikat Pangan Industri Rumah Tangga, perlu adanya perizinan yang sah pada setiap pelaku UMKM khususnya dari produk olahan.
                Selain sosialisasi tentang izin PIRT, akan sedikit menyampaikan terkait pentingnya dan bagaimana efeknya UMKM terhadap penunjang perekonomian desa. Juga akan diberikan sedikit tips-tips mengenai marketing yang baik yang berbasis TIK. Pembinaan ini diharapkan dapat membantu UMKM disini baik dalam bidang manajemen ataupun bidang profitnya. Salah satu hasil dari pembinaan tersebut oleh mahasiswa KKN Kolaboratif kelompok 25 yaitu pada salah satu UMKM di bidang kuliner "IRMIAA CAKE AND BAKERY". Usaha tersebut sangat terbantu dengan pembinaan ini, mulai memiliki logo produk, penentuan titik lokasi dari rumah produksi sesuai dengan maps agar lebih mudah di akses orang lain, dan memiliki banner produk. Dimulai dari usaha "IRMIAA CAKE AND BAKERY" ini, diharapkan usaha-usaha lainnya juga merasa terbantu dengan pembinaan ini dan mengikuti jejak usaha Bu Irmiaa ini.
                Selain dari segi manajemen, marketing untuk usahanya juga harus ditingkatkan. Strategi pemasaran melalui media online juga diaplikasikan untuk membantu meningkatkan pemasaran dan penjualan dengan jangkauan yang lebih luas. Pemanfaatan media sosial seperti whatsapp, facebook, dan khususnya instagram dibuat khusus untuk mengunggah produk yang dibuat, serta diberikan tautan link maps dan katalog dari produk untuk memudahkan pelanggan dalam mengakses info pemesanan. Diharapkan setelah pembinaan yang dilakukan oleh mahasiswa KKN Kolaboratif kelompok 25 ini akan membantu pengembangan UMKM di Desa Wringintelu ini, sehingga dapat menunjang perekonomian desa dari sektor lain pertanian.',
                'tgl_pelaksanaan' => now(),
                'thumbnail' => 2,
                'id_kategori' => 2,
                'is_aktif' => '1',
                'created_by' => '1',
            ],
        );
    }
}
