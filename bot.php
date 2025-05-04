<?php
ini_set('display_errors',1);
ob_start();
error_reporting(0);
date_Default_timezone_set("Asia/Tashkent");
$soat=date('H:i');
define('API_KEY','6195605012:AAHUAWzDrM1oP2pXwBcoGzCY0vq6dPv0QiY');
echo file_get_contents('https://api.telegram.org/bot'.API_KEY.'/setwebhook?url='.$_SERVER["SERVER_NAME"].''.$_SERVER["SCRIPT_NAME"].'&allowed_updates=["message","edited_message","channel_post","inline_query","query","callback_query","my_chat_member","chat_member"]');
$admin = '1897925266';
$bot = bot('getme',['bot'])->result->username;
print_r( bot('getme',['bot'])->result);
include ("sql.php");
include ("panel.php");

function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/$method";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch)); 
}else{
return json_decode($res);
}
}



$api_url = "https://cl2653.clouduz.ru/Shazam/shz.php";
// https://cl2653.clouduz.ru/Shazam/shz.php
$bot_manzili = "https://cl2653.clouduz.ru/Shazam";
// https://cl2653.clouduz.ru/Shazam



$botname = "@VekaMusic_Bot";


$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$cid = $message->chat->id;
$chat_id = $message->chat->id;
$uid = $message->from->id;
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$name = $message->chat->first_name;
$user = $message->chat->username;
$data = $update->callback_query->data;
$cid2 = $update->callback_query->message->chat->id;
$callbackQuery = $update->callback_query;
$chatType = $callbackQuery->message->chat->type;
$uid2 = $update->callback_query->from->id;
$mid2 = $update->callback_query->message->message_id;
$step = file_get_contents("step/$cid.step");
mkdir("step");

       if($type == "private"){
$result = mysqli_query($db,"SELECT * FROM users WHERE user_id = '$cid'");
$row = mysqli_fetch_assoc($result);
$lang=$row["lang"];
           
       }
 if($type == "group" or $type == "supergroup"){
    $result = mysqli_query($db,"SELECT * FROM `groups` WHERE chat_id = '$cid'");
$row = mysqli_fetch_assoc($result);
$lang=$row["lang"];
}


$result2 = mysqli_query($db,"SELECT * FROM users WHERE user_id = '$cid2'");
$row2 = mysqli_fetch_assoc($result2);
$lang2=$row2["lang"];

$result22 = mysqli_query($db,"SELECT * FROM `groups` WHERE chat_id = '$cid2'");
$row22 = mysqli_fetch_assoc($result22);
$lang22=$row22["lang"];
$til = json_encode([
'inline_keyboard'=>[
[['text'=>"🇺🇿 O'zbekcha",'callback_data'=>"lang_uz"]],[['text'=>"🇺🇲 English",'callback_data'=>"lang_en"]],
[['text'=>"🇷🇺 Русский",'callback_data'=>"lang_ru"]],
]
]);

if($type=="private" or $chatType =="private"){
if($lang=='uz' or $lang2=='uz'){
$info = "<a href='http://t.me/$bot'>🎧$bot</a><b> biz bilan musiqalarni oson toping 👈</b>";
$add=json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Guruhga qoʻshish",'url'=>"https://t.me/$bot?startgroup=on&admin=delete_messages+restrict_members+pin_messages+promote_members+change_info+post_messages+edit_messages+invite_users"]],
]
]);
}else if($lang=='ru' or $lang2 =='ru'){
$info = "<a href='http://t.me/$bot'>🎧$bot</a><b> легко находите музыку вместе с нами 👈</b>";
$add=json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Добавить в группу",'url'=>"https://t.me/$bot?startgroup=on&admin=delete_messages+restrict_members+pin_messages+promote_members+change_info+post_messages+edit_messages+invite_users"]],
]
]);
}else if($lang =='en' or $lang2 == 'en'){
$info = "👉 <a href='http://t.me/$bot'>🎧$bot</a><b> find music easily with us 👈</b>";    
$add=json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Add group",'url'=>"https://t.me/$bot?startgroup=on&admin=delete_messages+restrict_members+pin_messages+promote_members+change_info+post_messages+edit_messages+invite_users"]],
]
]);
}
}
$first_name = $callbackQuery->from->first_name;
if($type=="group" or $type=="supergroup" or $chatType=="group" or $chatType=="supergroup" ){
if($lang=='uz' or $lang22 =='uz'){
$info = "<b>Xurmatli <a href='tg://user?id=$uid2'>$first_name </a>tanlagan musiqangiz </b>,

<a href='http://t.me/$bot'>🎧$bot</a><b> biz bilan musiqalarni oson toping 👈</b>";
$add=json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Guruhga qoʻshish",'url'=>"https://t.me/$bot?startgroup=on&admin=delete_messages+restrict_members+pin_messages+promote_members+change_info+post_messages+edit_messages+invite_users"]],
]
]);
}else if($lang=='ru' or $lang22 =='ru'){
$info = "<b>Дорогой <a href='tg://user?id=$uid2'>$first_name </a>твоя любимая музыка,</b>

<a href='http://t.me/$bot'>🎧$bot</a><b> легко находите музыку вместе с нами 👈</b>";
$add=json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Добавить в группу",'url'=>"https://t.me/$bot?startgroup=on&admin=delete_messages+restrict_members+pin_messages+promote_members+change_info+post_messages+edit_messages+invite_users"]],
]
]);
}else if($lang =='en' or $lang22=='en'){
$info = "<b> Dear <a href='tg://user?id=$uid2'>$first_name </a> your music of choice</b> ,

<a href='http://t.me/$bot'>🎧$bot</a><b> find music easily with us 👈</b>";    
$add=json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Add group",'url'=>"https://t.me/$bot?startgroup=on&admin=delete_messages+restrict_members+pin_messages+promote_members+change_info+post_messages+edit_messages+invite_users"]],
]
]);
}
}





if($type == "private"){
$result = mysqli_query($db, "SELECT * FROM users WHERE user_id = '$cid'");
$row = mysqli_fetch_assoc($result);
if($row){
}else{
mysqli_query($db, "INSERT INTO users(user_id, lang) VALUES ('$cid','uz')");
}
}

if($type == "group" or $type == "supergroup"){
$result = mysqli_query($db, "SELECT * FROM `groups` WHERE chat_id = '$cid'");
$row = mysqli_fetch_assoc($result);
if($row){
}else{
mysqli_query($db, "INSERT INTO `groups`(chat_id,lang) VALUES ('$cid','null')");
}
}




if($text == "/start" or $text == "/start@$bot"){ 
if($lang ==null){
	bot('sendmessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Please, select a new language!</b>",
	'parse_mode'=>"html",
	'reply_markup'=>$til,
]);


}elseif($lang == "uz"){
	bot('sendmessage',[
	'chat_id'=>$cid,
'text'=>"<b>🔥 Assalomu alaykum. @$bot ga Xush 

Shazam funksiya:
• Qo‘shiq nomi yoki ijrochi ismi
• Qo‘shiq matni
• Ovozli xabar
• Video
• Audio
• Video xabar

🚀 Media yuklashni boshlash uchun uning havolasini yuboring.
Bot guruhlarda ham ishlay oladi!</b>",
	'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Guruxga qo'shish",'url'=>"https://telegram.me/$bot?startgroup=true"]],
]
]),
]);
exit();
}elseif($lang == "ru"){
	bot('sendmessage',[
	'chat_id'=>$cid,
	'text'=>"<b>🔥 Здравствуйте. Добро пожаловать в @$bot

Возможности Шазама:
• Название песни или имя исполнителя.
• Текст песни
• Голосовое сообщение
• Видео
• Аудио
• Видеосообщение

🚀 Отправьте ссылку на медиафайл, чтобы начать его загрузку.
Бот также может работать в группах!</b>",
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Добавить в группу",'url'=>"https://telegram.me/$bot?startgroup=true"]],
]
]),
]);
exit();
}elseif($lang == "en"){
	bot('sendmessage',[
	'chat_id'=>$cid,
		'text'=>"<b>🔥 Hello. Welcome to @$bot. You can download the following through the bot:

• Song title or artist name
• Lyrics
• Voice message
• Video
• Audio
• Video message

🚀 Submit your media link to start uploading it.
The bot can also work in groups!</b>",
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,	
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Add to groups",'url'=>"https://telegram.me/$bot?startgroup=true"]],
]
]),
]);
exit();
}
}






if(isset($message->text)){
    
    $text= str_replace(" ","+",$text);
     $api = file_get_contents("$api_url?text=$text");
     $a = json_decode($api, true);
     $img = $a['result'][0]['image'];
     $key = [];
      $a2 = "";
     for ($i = 0; $i < count($a['result']); $i++) {
         $ii = $i + 1;
         $title = $a['result'][$i]['title'];
         $name = $a['result'][$i]['name'];
 
         $a2 .= "$ii. $name - $title\n";
         $key[] = ["text" => $ii, "callback_data" => "music=$text=$ii"];
     }
     
     $tugma = array_chunk($key, 5);
    // $tugma[] = [['text' => '◀️ Orqaga', 'callback_data' => 'be']];
     $menyu = json_encode(['inline_keyboard' => $tugma]);
     
     bot('sendphoto', [
         'chat_id' => $cid,
         'photo' => $img,
         'caption' => "$a2",
         'reply_markup' => $menyu,
     ]);
      
 unlink("step/$cid.step");
 unlink("step/$cid.mp3");
 unlink("step/$cid.mp4");
 exit();
 }





 if(isset($message->voice)){
    $id = $message->voice->file_id;
    $path = bot('getfile',[
        'file_id'=>$id,
        ])->result->file_path;
        $url = 'https://api.telegram.org/file/bot'.API_KEY.'/'.$path;
file_put_contents("step/$cid.mp3",file_get_contents($url));

$api = "https://api3.haji-api.ir/majid/tools/shazam?url=$bot_manzili/step/$cid.mp3";
$a1 = file_get_contents("$api");
$a = json_decode($a1,true);
$url = $a['result']['hub']['actions'][1]['uri'];
$nomi = $a['result']['share']['subject'];

file_put_contents("step/$cid.mp3",file_get_contents($url));

bot('sendaudio',[
'chat_id'=>$cid,
'audio'=>new CURLFile("step/$cid.mp3"),
'thumb'=>new CURLFile("download.jpg"),
'performer'=>"$nomi",
'title'=>"@ShazamUzTgBot",
'caption'=>"<b>$nomi

$rek</b>",
'parse_mode'=>'html',
'reply_markup'=>$yoqdi_yoqmadi,
]);

unlink("step/$cid.step");
    unlink("step/$cid.mp3");
    unlink("step/$cid.mp4");
    
}





if($text == "/lang" or $text == "/lang@$bot"){
bot('sendmessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Please, select a new language!</b>",
	'parse_mode'=>"html",
	'reply_markup'=>$til,
]);
exit();
}
if($lang=='en'){
    $sticker="CAACAgIAAxkBAAEJ0zNkwgHz0OwAASGzpnLXFII1y2o3jkkAAgg2AAL6S-BJq7AdImdDwu8vBA";
}else if($lang=='uz'){
    $sticker="CAACAgIAAxkBAAEJ0zFkwgFZNO1JdudYkXlgM1lIa9gJnQACiSkAAoDw6EnO_gABFleF8hUvBA";
}else if ($lang=='ru'){
    $sticker="CAACAgIAAxkBAAEJ0zVkwgI4GQQNklql7_Z_xqCc2JDysAACDTAAAg8O6EkUSSFuqyLmJy8E";
}else{
      $sticker="CAACAgIAAxkBAAEJ0zFkwgFZNO1JdudYkXlgM1lIa9gJnQACiSkAAoDw6EnO_gABFleF8hUvBA";
}
if (preg_match("/lang_(.+)/ui", $data, $res)) {
    $lang=  $res[1];
    if($chatType == 'private'){
        mysqli_query($db, "UPDATE users SET lang='$lang' WHERE user_id='$cid2'");
  
    }else if($chatType == "group" or $chatType == "supergroup"){
          mysqli_query($db, "UPDATE `groups` SET lang='$lang' WHERE chat_id='$cid2'");
    }
bot('deleteMessage',[
'chat_id'=>$cid2,
'message_id'=>$mid2,
]);
if($lang == "uz"){
	bot('sendmessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>🔥 Assalomu alaykum. @$bot ga xush kelibsiz

• Qo‘shiq nomi yoki ijrochi ismi
• Qo‘shiq matni
• Ovozli xabar
• Video
• Audio
• Video xabar

🚀 Media yuklashni boshlash uchun uning havolasini yuboring.
Bot guruhlarda ham ishlay oladi!</b>",
	'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Guruxga qo'shish",'url'=>"https://telegram.me/$bot?startgroup=true"]],
]
]),
]);
exit();
}elseif($lang == "ru"){
	bot('sendmessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>🔥 Здравствуйте. Добро пожаловать в @$bot. Через бота можно скачать следующее:

• Instagram– с историями, публикациями и IGTV + аудио.

• TikTok — видео без водяных знаков;

Возможности Шазама:
• Название песни или имя исполнителя.
• Текст песни
• Голосовое сообщение
• Видео
• Аудио
• Видеосообщение

🚀 Отправьте ссылку на медиафайл, чтобы начать его загрузку.
😎 Бот также может работать в группах!</b>",
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Добавить в группу",'url'=>"https://telegram.me/$bot?startgroup=true"]],
]
]),
]);
exit();
}elseif($lang == "en"){
	bot('sendmessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>🔥 Hello. Welcome to @$bot. You can download the following through the bot:

• Instagram - with stories, posts and IGTV + audio

• TikTok - video without watermark;

Shazam features:
• Song title or artist name
• Lyrics
• Voice message
• Video
• Audio
• Video message

🚀 Submit your media link to start uploading it.
😎 The bot can also work in groups!</b>",
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,	
	'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"➕ Add to groups",'url'=>"https://telegram.me/$bot?startgroup=true"]],
]
]),
]);
exit();
}
}
if (mb_stripos($text, "instagram.com") !== false) {
    $wait = bot('sendSticker', [
        'chat_id' => $cid,
        'sticker' => $sticker,
        'parse_mode' => "html",
        'disable_web_page_preview' => true,
        'reply_to_message_id' => $message->message_id,
    ])->result->message_id;
$result = mysqli_query($db, "SELECT * FROM `instagram` WHERE url = '$text'");
$row = mysqli_fetch_assoc($result);
    bot('deleteMessage', [
        'chat_id' => $cid,
        'message_id' => $wait,
    ]);

if($row){
$videox = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `instagram` WHERE url = '$text'"))['file_id'];
 bot('sendVideo',[
'chat_id'=>$cid,
'video'=>$videox,
'caption'=>"
<b>$info</b>",
'parse_mode'=>"html",
 'reply_to_message_id' => $message->message_id,
]);
$file_info = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getFile?file_id=$videox"), true);
$file_path = $file_info["result"]["file_path"];
$audio_url = "https://api.telegram.org/file/bot".API_KEY."/$file_path";
    bot('deleteMessage', [
        'chat_id' => $cid,
        'message_id' => $wait,
    ]);
shazam($audio_url,$cid);
}else{
    $json = json_decode(file_get_contents("http://cl2653.clouduz.ru/Shazam/Api.php?url=$text"), true);
    if (empty($json)) {
        bot('sendmessage', [
            'chat_id' => $cid,
            'text' => "<b>Kechirasiz men Yopiq profildan video yuklay olmayman</b>",
            'parse_mode' => "html",
             'reply_to_message_id' => $message->message_id,
        ]);
    }
    $title = $json[0]['title'];
    $types = $json[0]['type'];
    $datas = [];
        $index = 0;
  if (count($json) == 1  ) {
      if($types == 'mp4'){
    $shahaz = bot('sendVideo', [
        'chat_id' => $cid,
        'video' =>new CURLFile( $json[0]['link']),
        'caption' => "<b>$title\n$info</b>",
        'parse_mode' => "html",
    ])->result->video->file_id;
    $file_info = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getFile?file_id=$shahaz"), true);
$file_path = $file_info["result"]["file_path"];
$audio_url = "https://api.telegram.org/file/bot".API_KEY."/$file_path";
    mysqli_query($db, "INSERT INTO `instagram`(url,file_id) VALUES ('$text','$shahaz')");
    shazam($audio_url,$cid);
      }else{
       bot('sendPhoto', [
        'chat_id' => $cid,
        'photo' =>new CURLFile( $json[0]['link']),
        'caption' => "<b>$title\n$info</b>",
        'parse_mode' => "html",
    ]);    
      }
} else{
    $datas = [];
    foreach ($json as $results) {
        $type = $results['type'];
        $url = $results['link'];
        $mediaType = ($type == "mp4") ? "video" : "photo";
            if ($index == 0) {
                $datas[] = [
                    'type' => $mediaType,
                    'media' => $url,
                    'caption' => "$title\n<b>$info</b>",
                    'parse_mode' => "html",
                ];
            } else {
                $datas[] = [
                    'type' => $mediaType,
                    'media' => $url,
                ];
            }
            $index++;
    }
    bot('sendMediaGroup', [
        'chat_id' => $cid,
        'media' => json_encode($datas),
         'reply_to_message_id' => $message->message_id,
    ]);
}

}
}





if(mb_stripos($text, "tiktok.com")!==false){
$wait = bot('sendSticker',[
	'chat_id'=>$cid,
	'sticker'=>$sticker,
	'parse_mode'=>"html",
	'disable_web_page_preview'=>true,
	'reply_to_message_id'=>$message->message_id,
])->result->message_id;
$result = mysqli_query($db, "SELECT * FROM `tiktok` WHERE url = '$text'");
$row = mysqli_fetch_assoc($result);
if($row){
$videox = mysqli_fetch_assoc(mysqli_query($db,"SELECT*FROM tiktok WHERE url = '$text'"))['file_id'];
$audios = mysqli_fetch_assoc(mysqli_query($db,"SELECT*FROM tiktok WHERE url = '$text'"))['audio_id'];
    bot('sendVideo',[
'chat_id'=>$cid,
'video'=>$videox,
'caption'=>"
<b>$info</b>",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
	'reply_markup'=>$add,
]);
bot('sendAudio',[
'chat_id'=>$cid,
'audio'=>$audios,
'caption'=>"$title

<b>$info</b>",
'parse_mode'=>"html",
'reply_to_message_id'=>$message->message_id,
	'reply_markup'=>$add,
]);
$file_info = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getFile?file_id=$audios"), true);
$file_path = $file_info["result"]["file_path"];
$audio_url = "https://api.telegram.org/file/bot".API_KEY."/$file_path";
    bot('deleteMessage', [
        'chat_id' => $cid,
        'message_id' => $wait,
    ]);
shazam($audio_url,$cid);
}else{
$json = json_decode(file_get_contents("https://shaha.u11117.xvest2.ru/Video%20Downloader/tiktok.php?url=$text"), true); 
$username = $json['user']['username'];
$name = $json['user']['name'];
$image = $json['user']['image'];
$url = $json['video_no_watermark']['url'];
$audio = $json['audio']['url'];
$shaha = bot('sendVideo',[
'chat_id'=>$cid,
'video'=>new CURLFile($url),
'caption'=>"

<b>$info</b>",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$message->message_id,
	'reply_markup'=>$add,
])->result->video->file_id;
$zor =bot('sendAudio',[
'chat_id'=>$cid,
'audio'=>new CURLFile($audio),
'caption'=>"$title

<b>$info</b>",
'parse_mode'=>"html",
'reply_to_message_id'=>$message->message_id,
	'reply_markup'=>$add,
])->result->audio->file_id;
bot('deleteMessage',[
'chat_id'=>$cid,
'message_id'=>$wait,
]);
mysqli_query($db, "INSERT INTO `tiktok`(url,file_id,audio_id) VALUES ('$text','$shaha','$zor')");
    bot('deleteMessage', [
        'chat_id' => $cid,
        'message_id' => $wait,
    ]);
shazam($audio,$cid);
}
}
if(mb_stripos($text,"music.yandex")!==false){    
    $wait = bot('sendSticker', [
        'chat_id' => $cid,
        'sticker' => $sticker,
        'parse_mode' => "html",
        'disable_web_page_preview' => true,
        'reply_to_message_id' => $message->message_id,
    ])->result->message_id;
$uid2 = $message->from->first_name;
$album =explode("/album/",$text)[1];
$album1 =explode("/",$album)[0];
$key1 =explode("/track/",$album)[1];
if(mb_stripos($key1,"?")!==false){    
  $filenamePos = strpos($key1, '?');
$key = substr($key1, 0, $filenamePos);
}else{
    $key =$key1;
}
    $result = mysqli_query($db, "SELECT * FROM `music` WHERE music_id = '$key'");
$row = mysqli_fetch_assoc($result);
if($row){
    $name=$row["name"];
    $artist=$row["artist"];
$videox = mysqli_fetch_assoc(mysqli_query($db,"SELECT*FROM music WHERE music_id = '$key'"))['file_id'];
bot('sendAudio',[
  'chat_id'=>$cid,
  'audio' => $videox,
  "caption"=>"<i></i>

$info",
  'parse_mode'=>"html",
  'reply_markup'=>$add,

]);
    bot('deleteMessage', [
        'chat_id' => $cid,
        'message_id' => $wait,
    ]);
exit();
}
}
    
    
if(isset($message->text)){
    
    $text= str_replace(" ","+",$text);
     $api = file_get_contents("$api_url?text=$text");
     $a = json_decode($api, true);
     $img = $a['result'][0]['image'];
     $key = [];
      $a2 = "";
     for ($i = 0; $i < count($a['result']); $i++) {
         $ii = $i + 1;
         $title = $a['result'][$i]['title'];
         $name = $a['result'][$i]['name'];
         $url = $a['result'][$i]['Audio url'];
 
         $a2 .= "$ii. $name - $title\n";
         $key[] = ["text" => $ii, "callback_data" => "music=$name=$i"];
     }
     
     $tugma = array_chunk($key, 5);
     $menyu = json_encode(['inline_keyboard' => $tugma]);
     
     bot('sendphoto', [
         'chat_id' => $cid,
         'photo' => $img,
         'caption' => "$a2",
         'reply_markup' => $menyu,
     ]);
      
 unlink("step/$cid.step");
 unlink("step/$cid.mp3");
 unlink("step/$cid.mp4");
 exit();
 }
 
 if(mb_stripos($data, "music=")!==false){
    bot('answerCallbackQuery',[
        'callback_query_id'=>$cqid,
        'text'=>"⏳ Kuting , Yuklanmoqda ...",
        ]);
    $text = explode("=",$data)[1];
    $son = explode("=",$data)[2];
   
    $api = file_get_contents("$api_url?text=$text");
    $a = json_decode($api, true);
    $title = $a['result'][$son]['title'];
    $name = $a['result'][$son]['name'];
    $url = $a['result'][$son]['Audio url'];

     bot('sendaudio',[
     'chat_id'=>$cid2,
     'audio'=>new CURLFile("$url"),
     'caption'=>"<b>$name-$title $botname</b>",
     'parse_mode'=>'html',
     ]);
}

if(isset($message->voice)){
 mkdir("step/$cid");
    $id = $message->voice->file_id;
    $path = bot('getfile',[
        'file_id'=>$id,
        ])->result->file_path;
        $url = 'https://api.telegram.org/file/bot'.API_KEY.'/'.$path;
put("step/$cid/$cid.mp3",get($url));

$api = "https://api3.haji-api.ir/majid/tools/shazam?url=https://ani.u12354.xvest1.ru/vkm/step/$cid/$cid.mp3";
$a1 = file_get_contents("$api");
$a = json_decode($a1,true);
$url = $a['result']['hub']['actions'][1]['uri'];
$nomi = $a['result']['share']['subject'];


sms($cid,"  Qidirilmoqda",null);
bot('sendaudio',[
'chat_id'=>$cid,
'audio'=>new CURLFile($url),
'caption'=>"<b>$nomi

$rek</b>",
'parse_mode'=>'html',
'reply_markup'=>$yoqdi_yoqmadi,
]);
    unlink("step/$cid/$cid.mp3");
    unlink("step/$cid/$cid.mp4");
    
}

//Zayafka funksiya
$join = $update->chat_join_request;
$jcid = $update->chat_join_request->chat->id;
$jtitle = $update->chat_join_request->chat->title;
$juser = $update->chat_join_request->chat->username;
$jurl = $update->chat_join_request->chat->invite_link;
$jfid = $update->chat_join_request->from->id;
$fname = $update->chat_join_request->from->first_name;
$jtype = $update->chat_join_request->chat->type;

if(isset($join) and $jtype == "channel"){
bot("approveChatJoinRequest",[
"chat_id"=>$jcid,
"user_id"=>$jfid,
]);
bot('sendmessage',[
'chat_id'=>$jfid,
'text'=>"Salom! Qo‘shiqni topib berishim uchun, menga quyidagilardan birini yuboring:

 • Qo‘shiq nomi yoki ijrochi ismi
 • Qo‘shiq matni
 • Tik-Tokdan link
 • Ovozli xabar
 • Video xabar
 • Audio
 • Video",
'parse_mode'=>'html',
]);
}


?>
