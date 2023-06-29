
<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="index.html">
  <span class="align-middle">Gembira Mart</span>
</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Main
			</li>

			<li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">
				<a class="sidebar-link" href="/">
					<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('penjualan') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('penjualan.index') }}">
					<i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Data Penjualan</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('penjualan-product') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('penjualan-product.index') }}">
					<i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Data Penjualan Product</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('product') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('product.index') }}">
					<i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Data Produk</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('persediaan') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('persediaan.index') }}">
					<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Data Persediaan</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('transaksi') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('transaksi.index') }}">
					<i class="align-middle" data-feather="tag"></i> <span class="align-middle">Data Transaksi</span>
				</a>
			</li>

			<li class="sidebar-header">
				Peramalan
			</li>

			<li class="sidebar-item {{ request()->is('peramalan-penjualan') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('peramalan-penjualan.index') }}">
					<i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Peramalan</span>
				</a>
			</li>

			<li class="sidebar-header">
				Admin
			</li>

			<li class="sidebar-item {{ request()->is('pengguna') ? 'active' : '' }}">
				<a class="sidebar-link" href="pengguna">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">Pengguna</span>
				</a>
			</li>
		</ul>
	</div>
</nav>
