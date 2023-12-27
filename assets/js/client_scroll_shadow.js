const testScroll = setTimeout(()=>{
    if(document.readyState == 'complete') {
        startScroll();
        clearTimeout(testScroll);
    }    
}, 500);

const startScroll = ()=>{

    window.onscroll = function() { clientScrollShadow(); };
    var root = document.getElementById('root');
    
    var topScroll = root.offsetTop;
    var bottomScroll = root.offsetTop;
    
    function clientScrollShadow() {
        if((window.pageYOffset + 20) >= topScroll) {
            document.getElementById('client-layout-top').classList.add('shadow');
        } else {
            document.getElementById('client-layout-top').classList.remove('shadow');
        }
        
        if((window.pageYOffset) <= topScroll) {
            document.getElementById('client-layout-bottom').classList.add('shadow');
        } else {
            document.getElementById('client-layout-bottom').classList.remove('shadow');
        }
    }

};
