<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            Message::create([
                'user_send_id' => $i,
                'user_receive_id' => $i + 1,
                'message_detail' => '日本国民は、正当に選挙された国会における代表者を通じて行動し、われらとわれらの子孫のために、諸国民との協和による成果と、わが国全土にわたつて自由のもたらす恵沢を確保し、政府の行為によつて再び戦争の惨禍が起ることのないやうにすることを決意し、ここに主権が国民に存することを宣言し、この憲法を確定する。そもそも国政は、国民の厳粛な信託によるものであつて、その権威は国民に由来し、その権力は国民の代表者がこれを行使し、その福利は国民がこれを享受する。これは人類普遍の原理であり、この憲法は、かかる原理に基くものである。われらは、これに反する一切の憲法、法令及び詔勅を排除する。日本国民は、恒久の平和を念願し、人間相互の関係を支配する崇高な理想を深く自覚するのであつて、平和を愛する諸国民の公正と信義に信頼して、われらの安全と生存を保持しようと決意した。われらは、平和を維持し、専制と隷従、圧迫と偏狭を地上か',
                'file1' => null,
                'file2' => null,
                'file3' => null,
                'is_read' => 0,
                'created_at' => '2021-01-10 03:07:56'
            ]);
        }
        for ($i = 1; $i < 10; $i++) {
            Message::create([
                'user_send_id' => $i + 1,
                'user_receive_id' => $i,
                'message_detail' => 'キャリアは決して順調とは言えず、高校卒業後は北京近郊の生産部隊で養豚業に従事していた（いわゆる下放）。25歳の時、軍の全総文工団（文芸工作団）に入団し新劇俳優として俳優業をスタート、1984年、偶然『盛夏和她的未婚夫』中の端役を演じたことから映画俳優としての道を歩むようになる。',
                'file1' => null,
                'file2' => null,
                'file3' => null,
                'is_read' => 0,
            ]);
        }
    }
}


