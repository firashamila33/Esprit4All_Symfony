//        localStorage.clear();
//        localStorage.removeItem('meals');
InitiateData();
function InitiateData(){
    //HERE I AM GETTING THE MEALS FROM LOCALSTOREGE AND CONVERTING THEM FROM STRING ARRAY TO JSON ;)
    data=JSON.parse(localStorage.getItem('stored_sohpcard_menu'));

    console.log(data);
    Update();
}
function Update(){
    //INITIATING SHOP-Card
    card_item_concatination='';
    //displaying shop-card items from JSON
    for (i=0;i<data.ShopCard.length;i++){
        card_item_concatination+='<div class="cart-item" id="row'+data.ShopCard[i].id_menu+'">'
        card_item_concatination+='<div class="cart-item-left">'
        card_item_concatination+='<img src="/www/Esprit4All_Symfony/web/FrontEnd/Food/images/'+data.ShopCard[i].path_img+'" alt="">'
        card_item_concatination+='</div>'
        card_item_concatination+='<div class="cart-item-right">'
        card_item_concatination+='<h6>'+data.ShopCard[i].libelle+'</h6>'
        card_item_concatination+='<span>'+data.ShopCard[i].quantite+' x '+data.ShopCard[i].prix+'$ </span>'
        card_item_concatination+='</div>'
        card_item_concatination+='<a href="#" onclick=DeleteFromShopCard('+data.ShopCard[i].id_menu+')><span class="delete-icon" ></span></a>'
        card_item_concatination+='</div>'
    }
    document.getElementById("card_item_render_block").innerHTML = card_item_concatination;
    TotalPrice();
}
function AddToShopCard(a){
    console.log('TAWWWA D5AAAALT LEL FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF');
    //TEST IF THIS MEAL ALREADY EXIST IN SHOP CARD
    var exist_in_card=false;
    //add quantity if meal already exist
    for (i=0;i<data.ShopCard.length;i++){
        if (data.ShopCard[i].id_menu==a){
            data.ShopCard[i].quantite++;
            exist_in_card=true;
            console.log(data);
            p=data.ShopCard[i].quantite;
            //CONVERTING THE DATA ARRAY TO JSON AND STORING IT TO LOCAL BROWSER STORAGE
            localStorage.setItem('stored_sohpcard_menu',JSON.stringify(data));
            //displaying total price
            TotalPrice();
            Update();


            concat='';
            concat='placeholder'+JSON.stringify(a);
            testas=document.getElementById(concat);
            if(testas!==null){
                document.getElementById(concat).placeholder = p;
            }
        }
    }
    //add to card if not
    if(exist_in_card==false){
                for (i=0;i<data.Menu.length;i++){
                    if(data.Menu[i].id==a){
                        obj={
                            id_menu:(data.Menu[i].id),
                            path_img :(data.Menu[i].pathImg),
                            type : (data.Menu[i].type),
                            categorie   : (data.Menu[i].categorie),
                            libelle : (data.Menu[i].libelle),
                            prix : (data.Menu[i].prix),
                            quantite   : 1 };

                    }
                }
        if (data.ShopCard.indexOf(obj) ==-1) {
            console.log('hnééééééé mahouch mawjouuuud');
            data.ShopCard.push(obj);
        }


        console.log(data);
        //CONVERTING THE DATA ARRAY TO JSON AND STORING IT TO LOCAL BROWSER STORAGE
        localStorage.setItem('stored_sohpcard_menu',JSON.stringify(data));
        //displaying total price
        TotalPrice();
        Update();
    }
}
function AddToShopCardSingleProd(a){
    //TEST IF THIS MEAL ALREADY EXIST IN SHOP CARD
    var exist_in_card=false;
    //add quantity if meal already exist
    for (i=0;i<data.ShopCard.length;i++){
        if (data.ShopCard[i].id_menu==a){
            vas = document.getElementById("placehlder_single").placeholder;
            aux=vas+data.ShopCard[i].quantite;
            data.ShopCard[i].quantite=aux;
            console.log(aux);
            exist_in_card=true;
            console.log(data);
            p=data.ShopCard[i].quantite;
            //CONVERTING THE DATA ARRAY TO JSON AND STORING IT TO LOCAL BROWSER STORAGE
            localStorage.setItem('stored_sohpcard_menu',JSON.stringify(data));
            //displaying total price
            TotalPrice();
            Update();
            concat='';
            concat='placeholder'+JSON.stringify(a);
            testas=document.getElementById(concat);
            if(testas!==null){
                document.getElementById(concat).placeholder = p;
            }
        }
    }
    //add to card if not
    if(exist_in_card==false){
        val = document.getElementById("placehlder_single").placeholder;
        for (i=0;i<data.Menu.length;i++){

            if(data.Menu[i].id==a){
                obj={
                    id_menu:(data.Menu[i].id),
                    path_img :(data.Menu[i].pathImg),
                    type : (data.Menu[i].type),
                    categorie   : (data.Menu[i].categorie),
                    libelle : (data.Menu[i].libelle),
                    prix : (data.Menu[i].prix),
                    quantite   : val };

            }
        }
        if (data.ShopCard.indexOf(obj) ==-1) {
            console.log('hnééééééé mahouch mawjouuuud');
            data.ShopCard.push(obj);
        }


        console.log(data);
        //CONVERTING THE DATA ARRAY TO JSON AND STORING IT TO LOCAL BROWSER STORAGE
        localStorage.setItem('stored_sohpcard_menu',JSON.stringify(data));
        //displaying total price
        TotalPrice();
        Update();
    }
}
function DeleteFromShopCard(id){
    for (i=0;i<data.ShopCard.length;i++){
        if(data.ShopCard[i].id_menu==id){
            data.ShopCard.splice(i,1);
            console.log(data);
            localStorage.setItem('stored_sohpcard_menu',JSON.stringify(data));

            TotalPrice();
            Update();
        }
    }

    d='raw'+JSON.stringify(id);
    parent=document.getElementById("item_render_parent");
    child=document.getElementById(d);
    parent.removeChild(child);



}
function DecreaseMealFromShopCard(id){
    for (i=0;i<data.ShopCard.length;i++){
        if(data.ShopCard[i].id_menu==id){
            if(data.ShopCard[i].quantite>1){
                data.ShopCard[i].quantite--;
                concat='';
                concat='placeholder'+JSON.stringify(data.ShopCard[i].id_menu);
                document.getElementById(concat).placeholder = data.ShopCard[i].quantite;
                TotalPrice();
                localStorage.setItem('stored_sohpcard_menu',JSON.stringify(data));
                Update();
            }
            else if(data.ShopCard[i].quantite==1){
                DeleteFromShopCard(id);

            }
        }
    }
}
function TotalPrice() {
    total_price=0;
    for (i=0;i<data.ShopCard.length;i++){
        total_price+=(data.ShopCard[i].prix)*(data.ShopCard[i].quantite);
    }
    total_container='';
    total_container+='<span>$'+total_price+'</span>';
    document.getElementById("total_price").innerHTML = total_container;
    document.getElementById("total_items_and_price").innerText=data.ShopCard.length+' items - $ '+total_price;
    //this below works with basket icon but can't remove orders rows
    //document.getElementById("total_items_and_price").get(0).lastChild.nodeValue=data.ShopCard.length+' items - $ '+total_price;

}
function ClearCard() {
    data.ShopCard=[];
    if(document.getElementById("item_render_parent")==null){
        document.getElementById("card_item_render_block").innerHTML='';
    }
    else if(document.getElementById("card_item_render_block")==null){
        document.getElementById("item_render_parent").innerHTML='';
    }
    else{
        document.getElementById("card_item_render_block").innerHTML='';
        document.getElementById("item_render_parent").innerHTML='';
    }

    TotalPrice();
    localStorage.setItem('stored_sohpcard_menu',JSON.stringify(data));
    Update();


}



$('#checkout_order').click(function() {

    var tmp = JSON.stringify(data.ShopCard);
    console.log(tmp);
    $.ajax({
        url: "../ajax_request",
        type: 'POST',
        dataType: 'json',
        data: tmp,
        async: true,
        success: function(data) {
            ClearCard();
            console.log('YES I AM AJAX');
            $('#list_food').toggle();
            $('#order_processing').toggle();
            $('#sign').addClass("active");
        },
        error: function() {

            console.log('nnnnnnnnnnnn');
        }
    });

});