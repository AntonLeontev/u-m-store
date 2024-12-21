function clickKati(items, block){
    document.querySelectorAll(items).forEach(function(item, index){
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            document.querySelectorAll(block).forEach(function(one, num){
                if (index == num){
                    one.style.display = 'block';
                } else {
                    one.style.display = 'none';
                }
            });
        });
    });
}
try{ 
    clickKati('.footerTitle', '.footerList');
} catch {}