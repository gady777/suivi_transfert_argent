<script>
  var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?33165';
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = url;
  var options = {
"enabled":true,
"chatButtonSetting":{
    "backgroundColor":"#4dc247",
    "ctaText":"",
    "borderRadius":"25",
    "marginLeft":"0",
    "marginBottom":"50",
    "marginRight":"50",
    "position":"left"
},
"brandSetting":{
    "brandName":"Transfert Union",
    "brandSubTitle":"Réponse rapide",
    "brandImg":"{{asset('assets/images/favicon.png')}}",
    "welcomeText":"Salut !\nEn quoi pouvons-nous vous aider ?",
    "messageText":"Salut, je veux discuter avec un membre de l'équipe de Transfert Union",
    "backgroundColor":"#0a5f54",
    "ctaText":"Commencer à disc.",
    "borderRadius":"25",
    "autoShow":false,
    "phoneNumber":"1(418)2657679"
}
};
  s.onload = function() {
      CreateWhatsappChatWidget(options);
  };
  var x = document.getElementsByTagName('script')[0];
  x.parentNode.insertBefore(s, x);
</script>
