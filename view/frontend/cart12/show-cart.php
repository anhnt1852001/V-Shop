  <div class="link">
      <div class="container">
          <div class="link__main">
              <span><a href="#">Home</a></span>
              <span>/ Giỏ hàng</span>
          </div>
      </div>
  </div>
  <section class="container cart">
      <div class="cart__main row">
          <div class="col-8">
              <div class="cart__main--left">
                  <div class="cart__header">
                      <span>Giỏ hàng</span>
                  </div>
                  <?php $tongtien = 0;
                    if (isset($_SESSION['cart'])) {
                        $so_sp = count($_SESSION['cart']);
                    }
                    ?>
                  <?php if (!empty($_SESSION['cart'])) : ?>
                      <?php foreach ($_SESSION['cart'] as $key => $SP) {
                            $ttsp = infoSP($SP['ma_hh']);

                        ?>
                          <div class="cart__content">
                              <div class="cart__image">
                                  <img class="img-fluid" src="<?= BASE_URL ?>/public/content/images/product/<?= $ttsp['hinh'] ?>" alt="">
                              </div>
                              <div class="cart__text">
                                  <div class="cart__title">
                                      <span class="d-inline-block text-truncate" style="max-width: 150px;"><?= $ttsp['ten_hh'] ?></span>
                                  </div>
                                  <div class="cart__price">
                                      <span><?= number_format($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01)) ?></span>
                                      <span><?= number_format($ttsp['don_gia']) ?></span>
                                  </div>
                              </div>
                                  <div class="cart__quantity row">
                                      <input type="hidden" name="ma_hh" value="<?= $SP['ma_hh'] ?>">
                                      <input type="hidden" name="gia_mua" value="<?= $SP['don_gia'] ?>">
                                      <input class="col-8" name="so_luong" readonly min="0" disabled value="<?= $SP['sl'] ?>">
                                      <div class="col-4">
                                          <?php if ($SP['sl'] < $ttsp['so_luong']) : ?>
                                              <a style="font-size:1.5rem" class="row text-decoration-none" href="<?= BASE_URL ?>/?controller=cart&action=up&id=<?= $ttsp['ma_hh'] ?>"><i class="fas fa-caret-up"></i></a>
                                          <?php else : ?>
                                              <a style="font-size:1.5rem" class="row text-decoration-none" onclick="return confirm('Hết sản phẩm!')"><i class="fas fa-caret-up"></i></a>
                                          <?php endif; ?>

                                          <?php if ($SP['sl'] > 1) : ?>
                                              <a style="font-size:1.5rem" class="row text-decoration-none" href="<?= BASE_URL ?>/?controller=cart&action=down&id=<?= $ttsp['ma_hh'] ?>"><i class="fas fa-caret-down"></i></a>
                                          <?php else : ?>
                                              <a style="font-size:1.5rem" class="row text-decoration-none" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="<?= BASE_URL ?>/?controller=cart&action=delete-cart&id=<?= $ttsp['ma_hh'] ?>"><i class="fas fa-caret-down"></i></a>
                                          <?php endif; ?>
                                      </div>

                                  </div>
                              <div class="cart__sum">
                                  <span>Thành tiền</span>
                                  <span><?= number_format($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01) * $SP['sl']) ?></span>
                              </div>
                              <div class="cart__delete--item">
                                  <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="<?= BASE_URL ?>/?controller=cart&action=delete-cart&id=<?= $ttsp['ma_hh'] ?>">
                                      <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                      </svg>
                                  </a>
                              </div>
                          </div>
                          <input type="hidden" value="<?= $tongtien += ($ttsp['don_gia'] * (1 - $ttsp['giam_gia'] * 0.01) * $SP['sl']); ?>">
                      <?php } ?>
              </div>
          </div>
      <?php else : ?>
          <?php echo $error  ?>
      <?php endif; ?>

      <?php if ($tongtien != 0) : ?>
          <div class="col-4">
              <div class="cart__main--right ">
                  <div class="cart__info">
                      <div>
                          <span>
                              <?php if (isset($so_sp)) {
                                    echo $so_sp . ' Sản Phẩm';
                                } ?>
                          </span>
                      </div>
                      <div>
                          <span id="tongtien">
                              <?php
                                echo number_format($tongtien);
                                ?>
                          </span>
                      </div>
                  </div>
                  <div class="cart__info cart__shipping">
                      <div>
                          <span>Phí giao hàng </span>
                      </div>
                      <div>
                          <span>30.000đ</span>
                      </div>
                  </div>
                  <div class="cart__info">
                      <div>
                          <span>Tổng</span>
                      </div>
                      <div>
                          <span>
                              <?php
                                echo number_format($tongtien += 30000);
                                ?>
                          </span>
                      </div>
                  </div>
                  <div class="cart__checkout">
                      <?php if (isset($_SESSION['ma_kh'])) : ?>
                          <a class="btn-dark p-3 " href="<?= BASE_URL ?>/?controller=cart&action=check-out">
                              <span>CHECK OUT </span>
                          </a>
                      <?php else : ?>
                          <a class="btn-dark p-3" href="<?= BASE_URL ?>/?controller=user&action=login">
                              <span>CHECK OUT </span>
                          </a>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>
  <?php endif; ?>
  </section>
