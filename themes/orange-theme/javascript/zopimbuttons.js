$(window).load(function(){
    $zopim.livechat.hideAll();
    $zopim.livechat.theme.setColor('#23A2CC');
    $zopim.livechat.theme.reload();
    
    $('.zopim-button').click(
        function(){
            $zopim.livechat.bubble.setColor('#1A1ACE');
            $zopim.livechat.theme.reload(); // apply new theme settings
            $zopim.livechat.badge.show();
        });

});