 <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>

        {{-- View Cart Modal goes here! --}}
<!-- Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <a type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-arrow-left"></i> Continue Shopping</a>
        </div>
        <div class="modal-body">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <p class="text-muted">
                                    Shopping Cart
                                </p>
                                <p>
                                    You have <span id="cartItems">No</span> items in shopping cart.
                                </p>
                                <table class="table table-responsive">
                                    <tbody id="productDisplayCart">
                                        {{-- <tr>
                                            <td class="text-center" colspan="4">No Items Found</td>
                                             <td>img</td>
                                            <td>Product name</td>
                                            <td>Price</td>
                                            <td>Qty</td>
                                            <td>Action</td> 
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success d-none" id="checkoutBtn" onclick="checkout()">Proceed To Checkout</button>
        </div>
      </div>
    </div>
</div>