function  scrollDU(srange,ele,x) {
    snum=$(ele).scrollTop();
    if (x==1){
        snum=snum+srange;
    }else{
        snum=snum-srange;
    }
    $(ele).scrollTop(snum);
}
