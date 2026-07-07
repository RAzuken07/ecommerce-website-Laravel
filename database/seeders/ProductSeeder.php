<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'makanan',
            'kandang',
            'sampo',
            'obat',
        ];

        $products = [
            ['name' => 'Beras Premium 10kg', 'category' => 'makanan', 'description' => 'Beras kualitas terbaik untuk kebutuhan sehari-hari keluarga.', 'price' => 85000, 'stock' => 50],
            ['name' => 'Mie Instan Jumbo', 'category' => 'makanan', 'description' => 'Paket mie instan ekstra besar untuk stok mingguan.', 'price' => 22000, 'stock' => 120],
            ['name' => 'Snack Kacang Panggang', 'category' => 'makanan', 'description' => 'Kacang panggang renyah dengan rasa gurih dan pedas.', 'price' => 18000, 'stock' => 90],
            ['name' => 'Susu UHT Cokelat', 'category' => 'makanan', 'description' => 'Susu UHT rasa cokelat segar untuk sarapan dan camilan.', 'price' => 15000, 'stock' => 70],
            ['name' => 'Selai Stroberi 250g', 'category' => 'makanan', 'description' => 'Selai buah stroberi dengan rasa manis alami.', 'price' => 29500, 'stock' => 40],
            ['name' => 'Roti Gandum 400g', 'category' => 'makanan', 'description' => 'Roti gandum sehat dengan tekstur lembut dan rasa alami.', 'price' => 19000, 'stock' => 60],
            ['name' => 'Kopi Bubuk Arabica', 'category' => 'makanan', 'description' => 'Kopi bubuk pilihan dengan aroma premium untuk pagi yang segar.', 'price' => 78000, 'stock' => 30],
            ['name' => 'Teh Celup Melati', 'category' => 'makanan', 'description' => 'Teh celup melati dengan rasa harum dan menenangkan.', 'price' => 23000, 'stock' => 80],
            ['name' => 'Biskuit Cokelat Crunch', 'category' => 'makanan', 'description' => 'Biskuit renyah dengan lapisan cokelat yang nikmat.', 'price' => 16500, 'stock' => 110],
            ['name' => 'Sari Buah Apel', 'category' => 'makanan', 'description' => 'Minuman sari buah apel yang segar dan menyegarkan.', 'price' => 27000, 'stock' => 42],
            ['name' => 'Keripik Singkong Pedas', 'category' => 'makanan', 'description' => 'Keripik singkong pedas renyah untuk cemilan sore.', 'price' => 21000, 'stock' => 74],
            ['name' => 'Madu Alami 500g', 'category' => 'makanan', 'description' => 'Madu asli pilihan yang cocok untuk campuran minuman dan masakan.', 'price' => 95000, 'stock' => 25],

            ['name' => 'Kandang Ayam Portable', 'category' => 'kandang', 'description' => 'Kandang ayam portable dengan desain mudah dipindah.', 'price' => 180000, 'stock' => 20],
            ['name' => 'Kandang Kelinci Aman', 'category' => 'kandang', 'description' => 'Kandang kelinci yang aman dan nyaman untuk hewan peliharaan.', 'price' => 165000, 'stock' => 18],
            ['name' => 'Pet Cargo Carrier', 'category' => 'kandang', 'description' => 'Carrier hewan peliharaan untuk perjalanan jauh dengan aman.', 'price' => 225000, 'stock' => 10],
            ['name' => 'Rumah Kucing Kayu', 'category' => 'kandang', 'description' => 'Rumah kucing kayu minimalis untuk kenyamanan anak kucing.', 'price' => 210000, 'stock' => 14],
            ['name' => 'Pagar PVC untuk Kandang', 'category' => 'kandang', 'description' => 'Pagar PVC ringan untuk membuat kandang hewan tahan lama.', 'price' => 128000, 'stock' => 34],
            ['name' => 'Sangkar Burung Anti Karat', 'category' => 'kandang', 'description' => 'Sangkar burung dengan bahan anti karat dan mudah dibersihkan.', 'price' => 192000, 'stock' => 12],
            ['name' => 'Kandang Anjing Portable', 'category' => 'kandang', 'description' => 'Kandang anjing portable dengan ventilasi luas dan bahan nyaman.', 'price' => 235000, 'stock' => 16],
            ['name' => 'Rumah Kura-Kura Indoor', 'category' => 'kandang', 'description' => 'Rumah kura-kura indoor yang aman dan mudah dibersihkan.', 'price' => 175000, 'stock' => 9],
            ['name' => 'Box Kandang Hamster', 'category' => 'kandang', 'description' => 'Box kandang hamster kecil dengan ruang bermain ekstra.', 'price' => 119000, 'stock' => 23],
            ['name' => 'Kandang Burung Parkit', 'category' => 'kandang', 'description' => 'Kandang parkit dengan aksesoris mainan dan tiang rivet.', 'price' => 149000, 'stock' => 19],
            ['name' => 'Kandang Reptil Mini', 'category' => 'kandang', 'description' => 'Kandang reptil mini untuk ular dan kadal kecil.', 'price' => 240000, 'stock' => 8],

            ['name' => 'Sampo Anti Ketombe', 'category' => 'sampo', 'description' => 'Sampo anti ketombe dengan formula lembut untuk rambut sehat.', 'price' => 42000, 'stock' => 55],
            ['name' => 'Sampo Vitamin B5', 'category' => 'sampo', 'description' => 'Sampo dengan vitamin B5 untuk rambut kuat dan berkilau.', 'price' => 38000, 'stock' => 47],
            ['name' => 'Sampo Untuk Rambut Kering', 'category' => 'sampo', 'description' => 'Sampo melembapkan untuk mengatasi rambut kering dan kusam.', 'price' => 40000, 'stock' => 52],
            ['name' => 'Sampo Anak Lembut', 'category' => 'sampo', 'description' => 'Sampo bayi dengan formula aman untuk kulit sensitif.', 'price' => 35000, 'stock' => 62],
            ['name' => 'Sampo Rambut Berminyak', 'category' => 'sampo', 'description' => 'Sampo khusus untuk rambut berminyak agar tetap segar.', 'price' => 39000, 'stock' => 44],
            ['name' => 'Sampo Perawatan Ekstra', 'category' => 'sampo', 'description' => 'Sampo perawatan ekstra untuk rambut rusak dan bercabang.', 'price' => 47000, 'stock' => 30],
            ['name' => 'Sampo Herbal Alami', 'category' => 'sampo', 'description' => 'Sampo herbal dengan bahan alami untuk kulit kepala sehat.', 'price' => 43500, 'stock' => 38],
            ['name' => 'Sampo Anti Rontok', 'category' => 'sampo', 'description' => 'Sampo anti rontok dengan ekstrak ginseng dan biotin.', 'price' => 46000, 'stock' => 41],
            ['name' => 'Sampo Anti Bakteri', 'category' => 'sampo', 'description' => 'Sampo anti bakteri untuk menjaga kebersihan kulit kepala.', 'price' => 42000, 'stock' => 33],
            ['name' => 'Sampo Lavender Relax', 'category' => 'sampo', 'description' => 'Sampo aroma lavender untuk relaksasi saat mandi.', 'price' => 44000, 'stock' => 35],

            ['name' => 'Obat Sakit Kepala', 'category' => 'obat', 'description' => 'Obat sakit kepala cepat dengan rasa tablet yang mudah ditelan.', 'price' => 26000, 'stock' => 90],
            ['name' => 'Obat Flu dan Batuk', 'category' => 'obat', 'description' => 'Obat flu dan batuk dengan ekstrak menthol untuk pernapasan lega.', 'price' => 32000, 'stock' => 80],
            ['name' => 'Obat Maag Herbal', 'category' => 'obat', 'description' => 'Obat maag herbal yang aman untuk lambung sensitif.', 'price' => 29000, 'stock' => 65],
            ['name' => 'Obat Pereda Nyeri', 'category' => 'obat', 'description' => 'Obat pereda nyeri cepat dan tahan lama.', 'price' => 34000, 'stock' => 75],
            ['name' => 'Multivitamin Keluarga', 'category' => 'obat', 'description' => 'Multivitamin untuk keluarga dengan vitamin lengkap.', 'price' => 55000, 'stock' => 45],
            ['name' => 'Obat Batuk Anak', 'category' => 'obat', 'description' => 'Sirup batuk anak yang manis dan mudah diminum.', 'price' => 28000, 'stock' => 58],
            ['name' => 'Obat Luka Luar', 'category' => 'obat', 'description' => 'Salep obat luka luar untuk kulit tergores dan lecet.', 'price' => 24000, 'stock' => 50],
            ['name' => 'Plester Antiseptik', 'category' => 'obat', 'description' => 'Plester antiseptik untuk perlindungan luka kecil.', 'price' => 15000, 'stock' => 150],
            ['name' => 'Minyak Gosok Tradisional', 'category' => 'obat', 'description' => 'Minyak gosok tradisional untuk meredakan pegal dan nyeri.', 'price' => 26000, 'stock' => 49],
            ['name' => 'Obat Sariawan', 'category' => 'obat', 'description' => 'Obat sariawan cepat dengan sensasi dingin alami.', 'price' => 21000, 'stock' => 76],
        ];

        foreach ($products as $index => $item) {
            Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'category' => $item['category'],
                'image' => sprintf('https://picsum.photos/seed/product-%d/600/400', $index + 1),
            ]);
        }
    }
}
