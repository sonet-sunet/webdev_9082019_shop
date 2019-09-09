class Catalog{
    constructor(){
        this.el = document.querySelector('.catalog');
        this.id = this.el.getAttribute('data-catalog-id');
        this.products = [];
        this.filters();
    }
    load(numPage = 1, val_category = 'all', val_size = 'all', val_price = 'all'){
        this.preloaderStart();
        let categoryValue;
        let sizeValue;
        let priceValue;;

        if(val_category == 'all') {
            categoryValue = '';
        } else {
            categoryValue = `&category=${val_category}`;
        }

        if(val_size == 'all') {
            sizeValue = '';
        } else {
            sizeValue = `&size=${val_size}`;
        }

        if(val_price == 'all') {
            priceValue = '';
        } else {
            let priceValueMin = val_price.split('-')[0];
            let priceValueMax = val_price.split('-')[1];

            console.log(priceValueMin);
            console.log(priceValueMax);

            priceValue = `&priceMin=${priceValueMin}&priceMax=${priceValueMax}`;

        }

        let xhr = new XMLHttpRequest();
        xhr.open('GET', `/handlers/catalogHandler.php?id=${this.id}&nowPage=${numPage}${categoryValue}${sizeValue}${priceValue}`);
        xhr.send();
        // this.preloadStart();
        xhr.addEventListener('load', ()=>{
            this.clearAll();

            let data = JSON.parse(xhr.responseText);
            //console.log(data);
            data.products.forEach((product)=>{
                this.products.push( new Product(product) );
            });
            // this.preloadStop();
            
            this.renderProducts();
            this.renderPagination(data.pagination);
            this.preloaderStop();
            //this.filters();
        });
    }
    filters(){
        let that = this;
        let filters = this.el.querySelector('.catalog-filters');
        let select = filters.querySelectorAll('.catalog-filters-select');
        let filterCategory = filters.querySelector('.category');
        let filterSize = filters.querySelector('.size');
        let filterPrice = filters.querySelector('.price');
        select.forEach((selectVal)=>{
            selectVal.addEventListener('change', function(){
                let n_category = filterCategory.options.selectedIndex;
                let val_category = filterCategory.options[n_category].value;
                let n_size = filterSize.options.selectedIndex;
                let val_size= filterSize.options[n_size].value;
                let n_price = filterPrice.options.selectedIndex;
                let val_price= filterPrice.options[n_price].value;
                //console.log(val_category);
                //console.log(val_size);
                //console.log(val_price);
                that.load(1, val_category, val_size, val_price);
            });
        });

        
    }
    renderPagination(pagination){
        let catalogPaginationEl = this.el.querySelector('.catalog-pagination');
        for(let i = 1; i <= pagination.countPage; i++){
            let paginationItemEl = document.createElement('div');
            paginationItemEl.classList.add('catalog-pagination-item');

            if( i == pagination.nowPage){
                paginationItemEl.classList.add('active');
            }

            paginationItemEl.innerText = i;
            paginationItemEl.setAttribute('data-num-page', i);

            let that = this;
            paginationItemEl.addEventListener('click', function(){
                let numPage = this.getAttribute('data-num-page'); 
                that.load(numPage);
            });

            /* */
            // paginationItemEl.addEventListener('click', (e)=>{
            //     let numPage = e.target.getAttribute('data-num-page'); 
            //     that.load(numPage);
            // });


            catalogPaginationEl.appendChild(paginationItemEl);
        }
    }
    renderProducts(){
        this.products.forEach((product)=>{
            this.el.querySelector('.catalog-products').appendChild( product.getElement() );
        })
    }
    clearAll(){
        this.el.querySelector('.catalog-products').innerHTML = '';
        this.el.querySelector('.catalog-pagination').innerHTML = '';
        this.products = [];
    }
    preloaderStart(){
        this.el.querySelector('.catalog-preloader').style.display = 'flex';
    }
    preloaderStop(){
        this.el.querySelector('.catalog-preloader').style.display = 'none';
    }

    // https://bit.ly/2Z1fESd
}  

class Product{
    constructor(product){
        this.id = product.id;
        this.name = product.name;
        this.pic = product.pic;
        this.price = product.price;
        this.text = product.text;
        this.sku = product.sku;

        this.el = document.createElement('a');
        this.el.classList.add('catalog-products-item');
        this.el.href = `/product.php?id=${this.id}`;
    }
    getElement(){
        this.el.innerHTML = `
            <div class='catalog-products-item-pic' style='background-image: url(/images/catalog/${this.pic})'></div>
            <div class='catalog-products-item-name'>${this.name}</div>
            <div class='catalog-products-item-price'>${this.price} руб.</div>
        `;

        return this.el;
    }

}

let catalog = new Catalog();
//console.log(catalog);
catalog.load();