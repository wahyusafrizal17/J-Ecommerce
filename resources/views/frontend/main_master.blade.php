<!DOCTYPE html>
<html lang="en">

<head>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Meta -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <meta name="author" content="">
  <meta name="keywords" content="MediaCenter, Template, eCommerce">
  <meta name="robots" content="all">
  <title>@yield('title')</title>

  <!-- Bootstrap Core CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css')}}">

  <!-- Customizable CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css')}}">

  <!-- Icons/Glyphs -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css')}}">

  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
    rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">


  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>

<body class="cnt-home">
  <!-- ============================================== HEADER ============================================== -->
  @include('frontend.body.header')

  <!-- ============================================== HEADER : END ============================================== -->

  @yield('content')

  <!-- /#top-banner-and-menu -->


  @include('frontend.body.footer')

  <!-- ============================================================= FOOTER ============================================================= -->

  <!-- ============================================================= FOOTER : END============================================================= -->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong id="pname"></strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-4">
              <div class="card" style="width: 18rem;">
                <img src="" id="pimage" class="card-img-top" style="width:100%" alt="...">
              </div>
            </div>

            <div class="col-md-4">
              <ul class="list-group">
                <li class="list-group-item">Product Price: Rp. <span id="price"></span> / Rp. <del id="oldprice"></del>
                </li>
                <li class="list-group-item">Product Code: <span id="pcode"></span></li>
                <li class="list-group-item">Category: <span id="pcategory"></span></li>
                <li class="list-group-item">Brand:<span id="pbrand"></span></li>
                <li class="list-group-item">Stock:<span id="pstock"></span></li>
              </ul>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="color">Color</label>
                <select class="form-control" id="color" name="color">
                </select>
              </div>
              <div class="form-group" id="sizeArea">
                <label for="size">Size</label>
                <select class="form-control" id="size" name="size">
                </select>
              </div>
              <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" name="" id="qty" class="form-control" value="1" min="1">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" id="product_id">
          <button type="button" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>

  <!-- For demo purposes – can be removed on production -->

  <!-- For demo purposes – can be removed on production : End -->

  <!-- JavaScripts placed at the end of the document so the pages load faster -->
  <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
  





  <!-- WOW.js untuk animasi -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- TAMBAHAN UNTUK HOT DEALS CAROUSEL -->
<!-- Owl Carousel CSS (Updated version untuk compatibility) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

       <script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "8000",         // 8 detik
        "extendedTimeOut": "2000", // waktu tambahan saat mouse diarahkan
        "positionClass": "toast-top-right"
    }

    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){ 
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>


  <script type="text/javascript">
        // Setup CSRF token untuk semua AJAX request
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // ✅ Fix di sini
    }
  });

        // Function untuk menampilkan data produk ke modal
        function productView(id) {
          $.ajax({
            type: 'GET',
            url: '/product/view/modal/' + id,
            dataType: 'json',
            success: function (data) {
              $('#pname').text(data.product.product_name_en);
              $('#price').text(data.product.selling_price);
              $('#pcode').text(data.product.product_code);
              $('#pcategory').text(data.product.category.category_name_en);
              $('#pbrand').text(data.product.brand.brand_name_en);
              $('#pstock').text(data.product.product_qty);
              $('#pimage').attr('src', '/' + data.product.product_thumbnail);
              $('#product_id').val(id);
              $('#qty').val(1);

              // Tampilkan harga (dengan atau tanpa diskon)
              if (data.product.discount_price == null) {
                $('#price').text(data.product.selling_price);
                $('#oldprice').text('');
              } else {
                $('#price').text(data.product.discount_price);
                $('#oldprice').text(data.product.selling_price);
              }

              // Isi color
              $('select[name="color"]').empty();
              $.each(data.color, function (key, value) {
                $('select[name="color"]').append('<option value="' + value + '">' + value + '</option>');
              });

              // Isi size
              $('select[name="size"]').empty();
              $.each(data.size, function (key, value) {
                $('select[name="size"]').append('<option value="' + value + '">' + value + '</option>');
              });

              // Tampilkan atau sembunyikan size jika kosong
              if (data.size == "") {
                $('#sizeArea').hide();
              } else {
                $('#sizeArea').show(); // ✅ Fix typo di sini juga
              }
            }
          });
  }
function addToCart() {
    let id = $('#product_id').val();
    let color = $('#color').val();
    let size = $('#size').val();
    let qty = $('#qty').val();

    $.ajax({
        type: "POST",
        url: "{{ route('cart.add', ['id' => ':id']) }}".replace(':id', id),
        data: {
            _token: "{{ csrf_token() }}",
            color: color,
            size: size,
            qty: qty
        },
        success: function(response) {
            $('#closeModal').click();

            Swal.fire({
                icon: response.status ? 'success' : 'warning',
                title: response.status ? 'Berhasil' : 'Gagal',
                text: response.message,
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error ' + xhr.status,
                text: xhr.responseJSON?.message || 'Terjadi kesalahan server',
                toast: true,
                position: 'top-end',
                timer: 5000,
                showConfirmButton: false
            });
        }
    });
}


       function addToCartFromWishlist(productId) {
  $.ajax({
    type: "POST",
    url: `/cart/add/${productId}`,
    data: {
      _token: "{{ csrf_token() }}",
      qty: 1,
      color: null,
      size: null
    },
    success: function (response) {
      // Cek jika status false → tampilkan notifikasi gagal
      if (response.status === false) {
        Swal.fire({
          icon: 'warning',
          title: 'Gagal',
          text: response.message || 'Produk tidak dapat ditambahkan ke keranjang',
          toast: true,
          position: 'top-end',
          timer: 3000,
          showConfirmButton: false
        });
        return; // Stop eksekusi selanjutnya
      }

      // Jika berhasil
      miniCart?.();

      Swal.fire({
        icon: 'success',
        title: response.message || 'Berhasil ditambahkan ke keranjang',
        toast: true,
        position: 'top-end',
        timer: 3000,
        showConfirmButton: false
      });

      // Opsional
      // removeFromWishlist(productId);
    },
    error: function (xhr) {
      Swal.fire({
        icon: 'error',
        title: 'Error ' + xhr.status,
        text: xhr.responseJSON?.message || 'Terjadi kesalahan server',
        toast: true,
        position: 'top-end',
        timer: 5000,
        showConfirmButton: false
      });
    }
  });
}
</script>

  <script type="text/javascript">
        function miniCart() {
          $.ajax({
            type: 'GET',
            url: "{{ route('mini.cart') }}",
            dataType: 'json',
            success: function (response) {

              // Update jumlah item & subtotal
              $('#cartQty').text(response.cartQty);
              $('#cartSubTotalTop').text(`Rp. ${response.cartTotal.toLocaleString('id-ID')}`);
              $('#cartSubTotalBottom').text(`Rp. ${response.cartTotal.toLocaleString('id-ID')}`);

              let miniCart = "";

              if (response.error) {
                miniCart = `<div class="alert alert-danger">${response.error}</div>`;
                return $('#miniCart').html(miniCart);
              }

              if (response.cartQty < 1) {
                miniCart = `<div class="text-center py-3">Keranjang kosong</div>`;
                return $('#miniCart').html(miniCart);
              }

              $.each(response.carts, function (key, value) {
                miniCart += `<div class="cart-item product-summary">
          <div class="row">
            <div class="col-xs-4">
              <div class="image">
                <a href="#">
                  <img src="/${value.options.image}" alt="${value.name}" style="max-width: 60px; height: auto;">
                </a>
              </div>
            </div>
            <div class="col-xs-7">
              <h3 class="name"><a href="#">${value.name}</a></h3>
              <div class="price">${value.qty} x Rp ${Number(value.price).toLocaleString('id-ID')}</div>
            </div>
            <div class="col-xs-1 action">
              <button type="button" onclick="miniCartRemove('${value.rowId}')">
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
        <hr>`;
              });


              $('#miniCart').html(miniCart);
            },
            error: function (xhr) {
              console.error(xhr.responseText);
              $('#miniCart').html('<div class="alert alert-danger">Gagal memuat keranjang</div>');
            }
          });
  }

        miniCart();
        setInterval(miniCart, 5000);

        function miniCartRemove(rowId) {
          $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/' + rowId,
            dataType: 'json',
            success: function (data) {
              if (data.success) {
                miniCart(); // Refresh tampilan mini cart
                Swal.fire({
                  icon: 'success',
                  title: data.success,
                  toast: true,
                  position: 'top-end',
                  timer: 2000,
                  showConfirmButton: false
                });
              }
            },
            error: function (xhr) {
              Swal.fire({
                icon: 'error',
                title: 'Gagal menghapus item',
                text: xhr.responseText || 'Terjadi kesalahan server',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
              });
            }
          });
}


  </script>



  <!-- Product Wishlist -->
  <script type="text/javascript">
        function addToWishlist(product_id){
          $.ajax({
            type: 'POST',
            url: '/user/add-to-wishlist/' + product_id,
            dataType: 'json',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (data) {
              if (data.success) {
                Swal.fire({
                  icon: 'success',
                  title: data.success,
                  toast: true,
                  position: 'top-end',
                  timer: 2000,
                  showConfirmButton: false
                });
              } else if (data.error) {
                Swal.fire({
                  icon: 'error',
                  title: data.error,
                  toast: true,
                  position: 'top-end',
                  timer: 3000,
                  showConfirmButton: false
                });
              }
            },
            error: function (xhr) {
              if (xhr.status === 401) {
                message = xhr.responseJSON?.error || 'Silahkan login terlebih dahulu';
              } else if (xhr.responseJSON?.message) {
                message = xhr.responseJSON.message;
              }
              Swal.fire({
                icon: 'error',
                title: message,
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
              });
            }
          });
}
  </script>
  <!-- End Product Wishlist -->

  <!-- Get data wishlist -->
  <style>
    .price .harga-diskon {
      text-decoration: none !important;
      color: black;
      font-weight: bold;
    }

    .price .harga-asli {
      color: gray;
      font-weight: bold;
      text-decoration: line-through !important;
    }
  </style>

  <script type="text/javascript">
        function getwishlist() {
          $.ajax({
            type: 'GET',
            url: '/user/get-wishlist-product',
            dataType: 'json',
            success: function (response) {
              let row = "";

              $.each(response, function (key, value) {
                let product = value.product;
                let hargaTampil = "";

                if (product.discount_price == null) {
                  hargaTampil = `Rp. ${product.selling_price}`;
                } else {
                  hargaTampil = `
              Rp. ${product.discount_price} 
              <span class="price-before-discount">Rp. ${product.selling_price}</span>
            `;
                }

                row += `
            <tr>
              <td class="col-md-2">
                <img src="/${product.product_thumbnail}" alt="${product.product_name_en}" style="max-width: 100px;">
              </td>
              <td class="col-md-7">
                <div class="product-name"><a href="#">${product.product_name_en}</a></div>
                <div class="rating">
                  <i class="fa fa-star rate"></i>
                  <i class="fa fa-star rate"></i>
                  <i class="fa fa-star rate"></i>
                  <i class="fa fa-star rate"></i>
                  <i class="fa fa-star non-rate"></i>
                  <span class="review">(06 Reviews)</span>
                </div>
                <div class="price">${hargaTampil}</div>
              </td>
              <td class="col-md-2">
                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"
                  onclick="addToCartFromWishlist(${product.id})">
                  Add to Cart
                </button>
              </td>
              <td class="col-md-1 close-btn">
               <button id="${value.id}" onclick="removeWishlist(this.id)" class="btn btn-danger">
               <i class="fa fa-times"></i>
              </button>
              </td>
            </tr>
          `;
              });

              $('#getWishlist').html(row);
            }
          });
  }

        // ✅ Pindahkan fungsi keluar dari ready supaya bisa diakses onclick
        function removeWishlist(id) {
          $.ajax({
            type: 'DELETE', // ✅ Sesuaikan dengan route
            url: `/user/remove-wishlist/${id}`,
            data: {
              _token: "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function (data) {
              if (data.success) {
                getwishlist(); // Refresh wishlist
                Swal.fire({
                  icon: 'success',
                  title: data.success,
                  toast: true,
                  position: 'top-end',
                  timer: 2000,
                  showConfirmButton: false
                });
              }
            },
            error: function (xhr) {
              Swal.fire({
                icon: 'error',
                title: 'Gagal menghapus item',
                text: xhr.responseText || 'Terjadi kesalahan server',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
              });
            }
          });
  }

        $(document).ready(function () {
          getwishlist(); // Muat wishlist saat pertama
  });
  </script>
  <!-- End Get data wishlist -->

  <!-- Get data MyCart -->

  <style>
    .price .harga-diskon {
      text-decoration: none !important;
      color: black;
      font-weight: bold;
    }

    .price .harga-asli {
      color: gray;
      font-weight: bold;
      text-decoration: line-through !important;
    }
  </style>

  <script type="text/javascript">
        function cart() {
          $.ajax({
            type: 'GET',
            url: '/get-mycart-product',
            dataType: 'json',
            success: function (response) {
              let row = "";

              $.each(response.carts, function (key, value) {
                let hargaTampil = `Rp. ${value.price}`;

                row += `
  <tr>
    <td class="col-md-2">
      <img src="/${value.options.image}" alt="${value.name}" style="max-width: 100px;">
    </td>

    <td class="col-md-3">
      <div class="product-name"><a href="#">${value.name}</a></div>
      <div class="rating">
        <i class="fa fa-star rate"></i>
        <i class="fa fa-star rate"></i>
        <i class="fa fa-star rate"></i>
        <i class="fa fa-star rate"></i>
        <i class="fa fa-star non-rate"></i>
        <span class="review">(06 Reviews)</span>
      </div>
      <strong>Rp. ${Number(value.price).toLocaleString('id-ID')}</strong>
    </td>

    <td class="col-md-1">
      <strong>${value.options.color}</strong>
    </td>

    <td class="col-md-1">
      ${value.options.size == null
                    ? `<strong>.....</strong>`
                    : `<strong>${value.options.size}</strong>`}
    </td>

  
  <td class="col-md-2">
    <!-- Tombol kurang (-) -->
    <button class="btn btn-sm btn-warning" 
            type="button" 
            data-rowid="${value.rowId}" 
            onclick="cartDecrement(this.dataset.rowid)">-</button>
    
    <!-- Input quantity -->
    <input type="text" 
           value="${value.qty}" 
           minn="1 max="100" disabled="" style="width:35px; height:26px">
    
    <!-- Tombol tambah (+) -->
    <button class="btn btn-sm btn-success" 
            type="button" 
            data-rowid="${value.rowId}" 
            onclick="cartIncrement(this.dataset.rowid)">+</button>
  </div>
</td>



    <td class="col-md-2">
      <strong>Rp. ${(value.price * value.qty).toLocaleString('id-ID')}</strong>
    </td>

    <td class="col-md-1 close-btn">
      <button id="${value.rowId}" onclick="removeCartItem(this.id)" class="btn btn-danger btn-sm">
        <i class="fa fa-times"></i>
      </button>
    </td>
  </tr>
`;
              });

              $('#getMyCart').html(row);
            }
          });
  }

        // Panggil fungsi cart saat halaman siap
        $(document).ready(function () {
          cart();
  });

// cartIncrement
// Cart increment function - Letakkan setelah function cart()
function cartIncrement(rowId) {
    console.log("Increment URL:", `/cart-increment/${rowId}`);
    
    $.ajax({
        type: 'GET',
        url: `/cart-increment/${rowId}`,
        dataType: 'json',
        beforeSend: function() {
            // Disable tombol sementara untuk mencegah double click
            $(`button[data-rowid="${rowId}"]`).prop('disabled', true);
        },
        success: function(data) {
            if (data.success) {
                // Update tampilan cart
                kuponCalculation();
                cart();
                miniCart();
                
                // Tampilkan notifikasi sukses
                Swal.fire({
                    icon: 'success',
                    title: data.message || 'Quantity berhasil ditambah',
                    toast: true,
                    position: 'top-end',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menambah quantity',
                    text: data.error || 'Terjadi kesalahan',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan',
                text: xhr.responseJSON?.message || 'Gagal menambah quantity',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        },
        complete: function() {
            // Enable kembali tombol
            $(`button[data-rowid="${rowId}"]`).prop('disabled', false);
        }
    });
}

// Cart decrement function
function cartDecrement(rowId) {
    console.log("Decrement URL:", `/cart-decrement/${rowId}`);
    
    $.ajax({
        type: 'GET',
        url: `/cart-decrement/${rowId}`,
        dataType: 'json',
        beforeSend: function() {
            $(`button[data-rowid="${rowId}"]`).prop('disabled', true);
        },
        success: function(data) {
            if (data.success) {
                // Update tampilan cart
                kuponCalculation()
                cart();
                miniCart();
                
                // Tampilkan notifikasi sukses
                Swal.fire({
                    icon: 'success',
                    title: data.message || 'Quantity berhasil dikurangi',
                    toast: true,
                    position: 'top-end',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengurangi quantity',
                    text: data.error || 'Terjadi kesalahan',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan',
                text: xhr.responseJSON?.message || 'Gagal mengurangi quantity',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        },
        complete: function() {
            $(`button[data-rowid="${rowId}"]`).prop('disabled', false);
        }
    });
}
// endcartincrement

        // Fungsi hapus item keranjang
        function removeCartItem(id) {
  $.ajax({
            type: 'POST',
            url: `/cart/remove/${id}`,
            data: {

              _token: $('meta[name="csrf-token"]').attr('content') // Ambil token CSRF dari meta tag
            },
            success: function (response) {
              cart(); // Refresh keranjang
              kuponCalculation();
              miniCart();
               $('#kuponFild').show (); 
              $('#kupon_name').val('');
              Swal.fire({
                icon: 'success',
                title: 'Item berhasil dihapus dari keranjang',
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
              });
            },
            error: function (xhr) {
              Swal.fire({
                icon: 'error',
                title: 'Gagal menghapus item',
                text: xhr.responseText || 'Terjadi kesalahan server',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
              });
            }
          });
}

  </script>

  <!-- End Get data MyCart -->


  <!-- function kupon apply -->

 <script type="text/javascript">
function applyKupon() {
  let kupon_name = $('#kupon_name').val().trim();

  if (!kupon_name) {
    Swal.fire({
      icon: 'warning',
      title: 'Masukkan kode kupon terlebih dahulu!',
      toast: true,
      position: 'top-end',
      timer: 2000,
      showConfirmButton: false
    });
    return;
  }

  $.ajax({
    type: 'POST',
    url: "{{ route('kupon.apply') }}",
    data: {
      kupon_name: kupon_name,
      _token: '{{ csrf_token() }}'
    },
    success: function(response) {
      Swal.fire({
        icon: 'success',
        title: 'Kupon berhasil diterapkan!',
        toast: true,
        position: 'top-end',
        timer: 2000,
        showConfirmButton: false
      });

      // Hilangkan form kupon setelah sukses apply
     

      // Update tampilan harga dan kupon
      kuponCalculation();
      $('#kuponFild').hide();
    },
    error: function(xhr) {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: xhr.responseJSON.error || 'Terjadi kesalahan',
        toast: true,
        position: 'top-end',
        timer: 3000,
        showConfirmButton: false
      });
    }
  });
}

function kuponCalculation() {
  $.ajax({
    type: 'GET',
    url: "{{ route('kupon.calculation') }}",
    success: function(data) {
      let html = '';

      function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      }

      if (data.total_amount) {
        // Tampilkan jika ada diskon
        html = `
          <table class="table">
            <thead>
              <tr>
                <th>
                  <div class="cart-sub-total">
                    <strong>Subtotal</strong>
                    <span class="inner-left-md">Rp. ${formatRupiah(data.subtotal)}</span>
                  </div>
                 <div class="cart-grand-total">
                        <strong>Nama Kupon</strong>
                        <span class="inner-left-md" style="color: #007bff;">
                          ${data.kupon_name}
                        </span>
                        <button 
                          type="button" 
                          onclick="kuponRemove()" 
                          class="btn btn-outline-danger btn-sm ms-2 px-2 py-1 rounded-pill shadow-sm"
                          style="font-size: 0.85rem;">
                          <i class="fa fa-times"></i> Hapus
                        </button>
                  </div>
                  <div class="cart-grand-total">
                    <strong>Diskon (${data.kupon_discount}%)</strong>
                    <span class="inner-left-md">Rp. -${formatRupiah(data.discount_amount)}</span>
                  </div>
                  <div class="cart-grand-total">
                    <strong style="color: green;">Grand Total</strong>
                    <span class="inner-left-md" style="color: green;">Rp. ${formatRupiah(data.total_amount)}</span>
                  </div>
                </th>
              </tr>
            </thead>
          </table>`;
      } else {
        // Jika tidak ada diskon / kupon
        html = `
          <table class="table">
            <thead>
              <tr>
                <th>
                  <div class="cart-sub-total">
                    <strong>Subtotal</strong>
                    <span class="inner-left-md">Rp. ${formatRupiah(data.total)}</span>
                  </div>
                  <div class="cart-grand-total">
                    <strong style="color: green;">Grand Total</strong>
                    <span class="inner-left-md" style="color: green;">Rp. ${formatRupiah(data.total)}</span>
                  </div>
                </th>
              </tr>
            </thead>
          </table>`;
      }

      $('#kuponData').html(html);

      // ✅ Tambahan agar kupon juga diperbarui ketika dipanggil dari proses lain
      // (contohnya setelah hapus item cart, refresh halaman, dsb)
    }
  });
}


// Panggil saat halaman dimuat
$(document).ready(function() {
  kuponCalculation();
});
</script>

<script type="text/javascript">
  function kuponRemove() {
    $.ajax({
      type: 'GET',
      url: "{{ route('kupon.remove') }}", // Gunakan named route agar lebih aman
      dataType: 'json',
      success: function(data) {
        // Refresh tampilan kupon dan keranjang
        kuponCalculation();
        $('#kuponFild').show (); 
        $('#kupon_name').val(''); // Kosongkan input kupon
        if (typeof kupon === 'function') {
          kupon(); // Pastikan fungsi kupon() ada untuk refresh keranjang
        }

        Swal.fire({
          icon: 'success',
          title: data.success || 'Kupon berhasil dihapus',
          toast: true,
          position: 'top-end',
          timer: 2000,
          showConfirmButton: false
        });
      },
      error: function(xhr) {
        Swal.fire({
          icon: 'error',
          title: 'Gagal menghapus kupon',
          text: xhr.responseJSON?.error || xhr.responseText || 'Terjadi kesalahan server',
          toast: true,
          position: 'top-end',
          timer: 3000,
          showConfirmButton: false
        });
      }
    });
  }
</script>

 <!-- end function kupon apply -->



  <!-- Stack untuk script tambahan dari halaman lain -->
  @stack('scripts')

</body>

</html>