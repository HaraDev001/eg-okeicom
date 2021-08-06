  @extends('okeicom.header')
  @section('title', '講師ご希望の方へ')
  @section('content')
<div id="container">
  <div class="midashi01">講師ご希望の方へ</div>
  <div class="center"><img src="/img/okeicom/teacher01.jpg" alt="メイン画像"></div>
  <p class="explain">『おけいcom』は、あなたの得意なことを活かして、好きな時間に好きな場所でレッスンを開講できるオンラインレッスンマッチングサイトです。</p>
  <p class="explain">あなたのスケジュールに合わせて、レッスン内容や料金は自由に設定することができるので、忙しい方でもご自身のペースで活動することができます。 </p>
  <p class="explain">プロ講師だけでなく、会社勤めの方、主婦の方、学生の方でもスキマ時間を生かして活躍いただけます！</p>
  <div class="midashi01">おけいcomの特徴</div>
  <div class="center">
    <div class="feature2"><img src="/img/okeicom/point01.png" width="60" alt="ポイント１"><br>
      <div class="midashi02">初期費用０円、システム手数料は25％！</div>
      <img src="/img/okeicom/teacher02.png" width="220" alt="特徴１"><br>
      <div class="text">登録料や掲載料は一切不要！システム手数料はレッスン売上に応じて、基本の25%から変動します。頑張れば頑張るほどお得になります。</div>
    </div>
    <div class="feature2"><img src="/img/okeicom/point02.png" width="60" alt="ポイント１"><br>
      <div class="midashi02">レッスン料の決済はサイト内で完結！</div>
      <img src="/img/okeicom/teacher03.png" width="220" alt="特徴２"><br>
      <div class="text">レッスン料の決済から売り上げたレッスン料の振込みまでサイト内で全て完結します。個人で高額な決済システムを 導入する必要はありません。</div>
    </div>
    <div class="feature2"><img src="/img/okeicom/point03.png" width="60" alt="ポイント１"><br>
      <div class="midashi02">安心・丁寧なサポート！</div>
      <img src="/img/okeicom/teacher04.png" width="220" alt="特徴３"><br>
      <div class="text">パソコン操作やネット利用が不安な方でも運営がサポートしているので安心です。困ったことがあれば、お気軽にお問い合わせください。</div>
    </div>
    <div class="feature2"><img src="/img/okeicom/point04.png" width="60" alt="ポイント１"><br>
      <div class="midashi02">手厚いプロモーション！</div>
      <img src="/img/okeicom/teacher05.png" width="220" alt="特徴４"><br>
      <div class="text">おけいcomは頑張る講師の皆さんを全力で応援します。レッスンのプロモーションはおけいcomにお任せ下さい。登録講師限定の特典もご用意しています。</div>
    </div>
  </div>
  <div class="midashi01">おけいcomの機能・サービス</div>
  <div class="center">
    <div class="feature3">
      <div class="midashi04">1.レッスン作成</div>
      <img src="/img/okeicom/service01.png" width="100" alt="サービス１"><br>
      <div class="text">レッスン予約ページが簡単に作成できます。レッスンはライブ、オンデマンド配信、パワーポイント販売が選べます。</div>
    </div>
    <div class="feature3">
      <div class="midashi04">2.決済代行</div>
      <img src="/img/okeicom/service02.png" width="100" alt="サービス２"><br>
      <div class="text">レッスン料は全ておけいcomのシステムを通して決済されます。安全かつ確実にレッスン料の受け取りが可能です。</div>
    </div>
    <div class="feature3">
      <div class="midashi04">3.メッセージ機能</div>
      <img src="/img/okeicom/service03.png" width="100" alt="サービス３"><br>
      <div class="text">サイト内でメッセージのやり取りが可能です。メールアドレスを交換する必要が無く、セキュリティ面でも安心です。</div>
    </div>
    <div class="feature3">
      <div class="midashi04">4.プロモーション支援</div>
      <img src="/img/okeicom/service04.png" width="100" alt="サービス４"><br>
      <div class="text">集客のための広告や宣伝はおけいcomにお任せ。チラシ制作やホームページ制作も特別価格でご提供しています。</div>
    </div>
    <div class="feature3">
      <div class="midashi04">5.振込手数料無料</div>
      <img src="/img/okeicom/service05.png" width="100" alt="サービス５"><br>
      <div class="text">売り上げたレッスン料は、サイト上から簡単に支払い請求が可能。その際の振込手数料は1万円以上の場合は無料です。</div>
    </div>
  </div>
  <div class="midashi01">手数料・お支払い</div>
  <div class="fee">
    <div class="midashi05">登録・掲載料　０円</div>
    登録料や掲載料は一切かかりません。<br>
    レッスン作成、予約管理、メッセージ配信、売上管理など必要な機能がすべて無料でお使いいただけます。</div>
  <div class="fee">
    <div class="midashi05">支払金額　＝レッスン売上―システム手数料(～25％)</div>
    おけいcomは、受講者へ提示されたレッスン料からシステム手数料を差し引いた金額を講師の方へお支払いします。<br>
    <span class="red">システム手数料は25%を基本とし</span>、1ヶ月の合計売上金額によって変動します。
    <table>
      <tr>
        <th>～100,000円までの部分</th>
        <td>25%</td>
      </tr>
      <tr>
        <th>100,000円超～150,000円未満</th>
        <td>23%</td>
      </tr>
      <tr>
        <th>150,000円超～200,000円未満</th>
        <td>20%</td>
      </tr>
      <tr>
        <th>200,000円超～250,000円未満</th>
        <td>18%</td>
      </tr>
      <tr>
        <th>250,000円超～300,000円未満</th>
        <td>15%</td>
      </tr>
      <tr>
        <th>300,000円超～</th>
        <td>13%</td>
      </tr>
    </table>
    ※既にお教室等を開講されている方で、生徒にオンラインレッスンを行うためにおけいcomを利用したい方はご相談ください。<br>
    最適なプランをご提案いたします。<a href="https://okeicom.com/contact/">お問い合わせはこちらから。</a></div>
  <div class="fee">
    <div class="midashi05">レッスン売上の支払方法</div>
    レッスン売上の支払いは、講師メニュー「入出金管理」ページより出金のリクエストをすることができます。<br>
    毎月月末を締め日として、翌月15日に、売上からシステム手数料を差し引いた金額を銀行口座にお振込みします。<br>
    （15日が銀行の非営業日である場合には直後の営業日）<br>
    <div style="margin: 10px;"><img src="/img/okeicom/calender.jpg" width="900" alt="振込カレンダー"></div>
    ※振込金額が１万円以上の場合、振込手数料は無料です。<span class="red">ただし、１万円未満の場合は講師負担となります。</span><br>
    ※出金リクエストを行わない場合は、翌月に持ち越されます。</div>
  <div class="midashi01">おけいcomの利用方法</div>
  <article>
    <div class="text_content">
      <div class="midashi03">１．Zoomをインストール</div>
      <p class="text_excerpt">おけいcomのライブレッスンでは、オンラインビデオ通話ツール『Zoom』を利用します。<br>
        お手持ちのパソコンやスマートフォンにインストールするだけで、インターネットさえあれば、いつでもどこでも気軽にレッスンが開講できるようになります。<br>
        ログインをすると、ミーティングアドレスが取得できるようになります。 <br>
        <a href="/zoom" class="btn-flat-border">Zoomインストール方法</a></p>
    </div>
    <figure> <img src="/img/okeicom/youtube.jpg" alt="インストール方法"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">２．無料会員登録</div>
      <p class="text_excerpt">おけいcomでオンラインレッスンを開講するには会員登録が必要です。<br>
        もちろん、登録料や利用料は一切かかりませんので、安心して始めていただけます。一つのアカウントで、講師としても受講者としても利用可能です。 <br>
        <a href="https://okeicom.com/sign-up" class="btn-flat-border">会員登録はコチラ</a> </p>
    </div>
    <figure> <img src="/img/okeicom/youtube.jpg" alt="無料会員登録"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">３．コース・レッスン作成</div>
      <p class="text_excerpt">会員登録が完了したら、さっそくレッスンを作成してみましょう。<br>
        まずは、コースを作成し、レッスンを追加します。１回限りのレッスンだけでなく、1コースには連続したレッスンの登録が可能です。<br>
        ライブレッスンの場合はzoomのミーティングアドレスが必要です。<br>
        <a href="#" class="btn-flat-border">講師マニュアル</a></p>
    </div>
    <figure> <img src="/img/okeicom/youtube.jpg" alt="コース・レッスン作成"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">４．レッスンスタート</div>
      <p class="text_excerpt">レッスン開始時刻直前になったら、zoomを起動させて待機します。<br>
        講師側からのレッスンのキャンセルは開始時刻の24時間前までは、やむを得ない事情の場合に限り可能です。ただし全ての受講者に必ず許可を取ってください。<br>
        生徒との連絡には、btn-flat-borderメッセージ機能をご利用ください。<br>
        <a href="https://okeicom.com/cancel-teacher" class="btn-flat-border">キャンセルポリシー</a> </p>
    </div>
    <figure> <img src="/img/okeicom/youtube.jpg" alt="レッスンスタート"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">５．レビュー投稿</div>
      <p class="text_excerpt">レッスンが終了したら生徒へレビュー投稿の依頼が送られます。<br>
        生徒側がレビューを登録すると、講師プロフィールに反映されます。</p>
    </div>
    <figure> <img src="/img/okeicom/youtube.jpg" alt="レビュー投稿"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">６．レッスン料支払い</div>
      <p class="text_excerpt">レッスンの売上は、講師メニュー「入出金管理」より振込請求ができます。<br>
        月末締めの翌月15日振込です。請求金額が1万円以上の場合、振込手数料は無料ですが、1万円未満の場合は講師側の負担となりますので、ご注意ください。 </p>
    </div>
    <figure> <img src="/img/okeicom/youtube.jpg" alt="レッスン料支払い"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">７．お困りの際は運営サポートへ</div>
      <p class="text_excerpt">困ったときはサポートにお気軽にご連絡ください。<br>
        <a href="https://okeicom.com/contact/" class="btn-flat-border">お問合わせ</a></p>
    </div>
    <figure> <img src="/img/okeicom/youtube.jpg" alt="運営サポートへ"> </figure>
  </article>
  <div class="midashi01">SNSの活用</div>
  <p class="explain">レッスンを開講したらご自身のブログ、Facebook、Instagram、Twitter、LINEなどのSNSでアナウンスしましょう！<br>
    各SNSの開設方法等については、こちらからご覧いただけます。<br>
  <div class="center"><a href="https://www.facebook.com/business/pages" class="btn-flat-border">Facebookページ</a><a href="https://business.instagram.com/getting-started?locale=ja_JP" class="btn-flat-border">Instagram</a><a href="https://help.twitter.com/ja/create-twitter-account" class="btn-flat-border">Twitter</a><a href="https://www.linebiz.com/jp/entry/" class="btn-flat-border">LINE公式アカウント</a></div>
  <div class="midashi01">プロモーションについて</div>
  <p class="explain">さらに、おけいcomでは、講師の方々が活躍いただけるようプロモーションにも力をいれています！
    </pb>
  <p class="explain">インターット上での広告や宣伝はもちろんのこと、ホームページやチラシ制作を登録講師限定の価格にて承っております。また、魅力ある講師の方にはプロモーション動画の撮影もいたします。(現在は京都近郊のみ。その他の地域は要相談)<br>
    詳しくはお気軽にお問い合わせください。</p>
  <div class="center">
    <div class="feature4">
      <div class="midashi02">＜HP制作・チラシ制作サポート＞</div>
      <img src="/img/okeicom/teacher-hp.jpg" alt="制作サポート"></div>
    <div class="feature4">
      <div class="midashi02">＜インタビュー動画制作＞</div>
      <div class="youtube">
        <iframe width="370" height="208" src="https://www.youtube.com/embed/fOf8FUsTpwk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <br>
        <iframe width="370" height="208" src="https://www.youtube.com/embed/rebrjwCxq-s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>
<div class="midashi01">困ったときは・・・</div>
<div class="btn-center"> <a href="#">
  <div class="btn1">よくある質問</div>
  </a> <a href="#">
  <div class="btn2">お問合わせ</div>
  </a> </div>
</div>
@endsection