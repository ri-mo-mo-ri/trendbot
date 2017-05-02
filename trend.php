<?php
$tweets = " ";
$RSSpath = [
  'https://queryfeed.net/twitter?q=from%3AKAI_YOU_ed&title-type=tweet-text-full&geocode=',
  'https://queryfeed.net/twitter?q=from%3AAnimeAnime_jp&title-type=tweet-text-full&geocode='
];

foreach ($RSSpath as $url) {
  $XML = simplexml_load_file ( $url, 'SimpleXMLElement', LIBXML_NOCDATA );

  $x=0; // カウントをリセット
  $num=3; // 指定した数で終了

foreach ( $XML->channel->item as $item ) {
    if ( $x>=$num ) { // 指定した数とマッチしたら終了
    break;
    }
    $x++; // カウントの追加
    $title = $item->title;
    $tweets = $tweets.$title."\n";

  }
}
$url = 'https://hooks.slack.com/services/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';
$data = [
  'text' => ''.$tweets,
  'username' => 'test',
  'icon_emoji' => ':soreike:',
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);
curl_close($ch);
