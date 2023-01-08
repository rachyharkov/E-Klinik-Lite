<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Work Mode" :link="route('workmode')" icon="bi bi-person-lines-fill"></x-maz-sidebar-item>
    <hr class="sidebar-divider">
    <x-maz-sidebar-item name="Pasien" :link="route('workmode')" icon="bi bi-person-bounding-box">
        <x-maz-sidebar-submenuitem name="Daftar Pasien" :link="route('pasien.index')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
        <x-maz-sidebar-submenuitem name="Jenis Pasien" :link="route('jenis_pasien.index')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Tindakan" icon="bi bi-clipboard2-plus">
        <x-maz-sidebar-submenuitem name="Data Utama" :link="route('tindakan')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
        <x-maz-sidebar-submenuitem name="Kategori Tindakan" :link="route('kategori_tindakan')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Obat/Barang" icon="bi bi-box-seam">
        <x-maz-sidebar-submenuitem name="Data Utama" :link="route('obat')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
        <x-maz-sidebar-submenuitem name="Kategori Obat" :link="route('kategori_obat')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
        <x-maz-sidebar-submenuitem name="Satuan Obat" :link="route('satuan_obat')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
        <x-maz-sidebar-submenuitem name="Jenis Penggunaan Obat" :link="route('jenis_penggunaan_obat')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
        <x-maz-sidebar-submenuitem name="Produsen" :link="route('produsen')" icon="bi bi-person"></x-maz-sidebar-submenuitem>
    </x-maz-sidebar-item>
    <hr class="sidebar-divider">
    <x-maz-sidebar-item name="Laporan" :link="route('laporan')" icon="bi bi-file-earmark-text"></x-maz-sidebar-item>

</x-maz-sidebar>
