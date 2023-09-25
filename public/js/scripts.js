/**
 * cart bucket functionality
 */

const cartBucket = () => {
    let products = localStorage.cart ? JSON.parse(localStorage.cart) : []
    let cartCount = products.length
    $('#cartCount').text(cartCount)
    $('#cartItems').text(cartCount)
    if(cartCount > 0) {
        populateCartList(products)
        $('#checkoutBtn').removeClass('d-none')
    }else{
        $('#checkoutBtn').addClass('d-none')
    }
}

const populateCartList = (products) => {
    let total = 0
    let list = products.map(l => {
        total += l.price * l.qty
        return ` <tr>
                    <td>
                    <img src="${l.img}"  class="rounded img-thumbnail" style="height: 50px; width: 50px;" alt="${l.name}"> ${l.name}</td>
                    <td>$${l.price}</td>
                    <td><input class="form-control text-center me-3" type="number" value="${l.qty}" style="max-width: 5rem" min="1" onchange="changeQtyInCart(${l.id}, this.value)" /></td>
                    <td>$${(l.price * l.qty).toFixed(2)}</td>
                    <td><button type="button" class="btn btn-outline-danger btn-sm"  onclick="removeProductFromCart(${l.id}, this)"><i class="fa fa-trash" title="Delete"></i></button></td> 
                </tr>`
    }).join(',')
    if(total) {
        list += `<tr><td colspan='3'><b>Grand Total</b></td><td><b>$${total.toFixed(2)}</b></td></tr>`
    }
    $('#productDisplayCart').html(list)
}

/**
 * Remove product from cart
 */
const removeProductFromCart = (id, el) => {
    let element = $(el)
    let products = localStorage.cart ? JSON.parse(localStorage.cart) : []
    let filteredProducts = products.filter(p => p.id != id)
    localStorage.setItem('cart', JSON.stringify(filteredProducts))
    cartBucket()
    element.parents('tr').remove()
}


/**
 * Change the cart quantity
 */

const changeQtyInCart = (id, qty) => {
    let products = localStorage.cart ? JSON.parse(localStorage.cart) : []
    let changedProducts = products.map(p => {
        if(p.id == id) {
            p.qty = qty
        }
        return p
    })
    localStorage.setItem('cart', JSON.stringify(changedProducts))
    cartBucket()
}

/**
 * Checkout functionality
 */

const checkout = () => {
    alert('Thanks for shopping!')
    localStorage.removeItem('cart')
    window.location.href = '/'
}
/** 
 * Call on load page 
*/
$(document).ready(function() {
    cartBucket()
})