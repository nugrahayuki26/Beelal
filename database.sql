-- CreateTable
CREATE TABLE `m_status_pelanggan` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `judul` VARCHAR(191) NOT NULL,
    `status` INTEGER NULL DEFAULT 0,

    UNIQUE INDEX `m_status_pelanggan_judul_key`(`judul`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_loc_provinsi` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `judul` VARCHAR(191) NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_loc_kota` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nama_kota` VARCHAR(191) NOT NULL,
    `id_provinsi` INTEGER NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_loc_kecamatan` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nama_kecamatan` VARCHAR(191) NOT NULL,
    `id_kota` INTEGER NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_loc_kelurahan` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nama_kelurahan` VARCHAR(191) NOT NULL,
    `id_kecamatan` INTEGER NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_pos_administrasi` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `judul` VARCHAR(191) NOT NULL,
    `status` INTEGER NULL DEFAULT 1,

    UNIQUE INDEX `m_pos_administrasi_judul_key`(`judul`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_pekerjaan` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `judul` VARCHAR(191) NOT NULL,
    `status` INTEGER NULL DEFAULT 1,

    UNIQUE INDEX `m_pekerjaan_judul_key`(`judul`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_tlb` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `judul` VARCHAR(191) NOT NULL,
    `status` INTEGER NULL DEFAULT 1,

    UNIQUE INDEX `m_tlb_judul_key`(`judul`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_kantor` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pb` VARCHAR(191) NOT NULL,
    `gd` VARCHAR(191) NOT NULL,
    `db` VARCHAR(191) NOT NULL,
    `an` VARCHAR(191) NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_keahlian` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `judul` VARCHAR(191) NOT NULL,

    UNIQUE INDEX `m_keahlian_judul_key`(`judul`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_orang` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nama_lengkap` VARCHAR(191) NOT NULL,
    `nik` VARCHAR(191) NULL,
    `jk` CHAR(2) NOT NULL,
    `tempat_lahir_id` INTEGER NULL,
    `tgl_lahir` DATETIME(3) NULL,
    `gol_darah` CHAR(2) NULL,
    `id_provinsi` INTEGER NULL,
    `id_kota` INTEGER NULL,
    `id_kecamatan` INTEGER NULL,
    `id_kelurahan` INTEGER NULL,
    `rt` INTEGER NULL,
    `rw` INTEGER NULL,
    `kode_pos` INTEGER NULL,
    `alamat_lengkap` VARCHAR(191) NULL,
    `pend_terahir` VARCHAR(191) NULL,
    `pend_nama_sekolah` VARCHAR(191) NULL,
    `pend_fakultas` VARCHAR(191) NULL,
    `pend_jurusan` VARCHAR(191) NULL,
    `pend_tahun_lulus` VARCHAR(191) NULL,
    `pend_keterangan` VARCHAR(191) NULL,
    `pkr_id_pekerjaan` INTEGER NULL,
    `penghasilan_ratarata` INTEGER NULL,
    `id_keahlian` INTEGER NULL,
    `id_tlb` INTEGER NULL,
    `no_wa` VARCHAR(191) NULL,
    `email` VARCHAR(191) NULL,
    `facebook` VARCHAR(191) NULL,
    `keterangan` TEXT NULL,

    UNIQUE INDEX `m_orang_nik_key`(`nik`),
    UNIQUE INDEX `m_orang_no_wa_key`(`no_wa`),
    UNIQUE INDEX `m_orang_email_key`(`email`),
    UNIQUE INDEX `m_orang_facebook_key`(`facebook`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_pelanggan` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_orang` INTEGER NOT NULL,
    `kode_pelanggan` INTEGER NOT NULL,
    `grade_terakhir` VARCHAR(191) NULL,
    `tahun_join` INTEGER NULL,
    `bk` TINYINT NULL DEFAULT 0,
    `kk` TINYINT NULL DEFAULT 0,
    `jml_asset_terakhir` INTEGER NULL,
    `id_status_pelanggan` INTEGER NULL,
    `status_marital` VARCHAR(191) NULL,
    `id_posisi_administrasi` INTEGER NULL,
    `created_by_user` INTEGER NOT NULL,
    `created_at` DATETIME(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),

    UNIQUE INDEX `m_pelanggan_id_orang_key`(`id_orang`),
    UNIQUE INDEX `m_pelanggan_kode_pelanggan_key`(`kode_pelanggan`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `m_relasi_pel` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nama_relasi` VARCHAR(191) NOT NULL,

    UNIQUE INDEX `m_relasi_pel_nama_relasi_key`(`nama_relasi`),
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `relasi_pelanggan` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_dari_pelanggan` INTEGER NOT NULL,
    `id_ke_pelanggan` INTEGER NOT NULL,
    `id_relasi` INTEGER NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `h_grade_pelanggan` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_pelanggan` INTEGER NOT NULL,
    `grade` VARCHAR(191) NOT NULL,
    `created_by_user` INTEGER NOT NULL,
    `created_at` DATETIME(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `h_data` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `id_user` INTEGER NOT NULL,
    `action` VARCHAR(191) NOT NULL,
    `data_before` TEXT NULL,
    `data_after` TEXT NULL,
    `created_at` DATETIME(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- AddForeignKey
ALTER TABLE `m_loc_kota` ADD CONSTRAINT `m_loc_kota_id_provinsi_fkey` FOREIGN KEY (`id_provinsi`) REFERENCES `m_loc_provinsi`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_loc_kecamatan` ADD CONSTRAINT `m_loc_kecamatan_id_kota_fkey` FOREIGN KEY (`id_kota`) REFERENCES `m_loc_kota`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_loc_kelurahan` ADD CONSTRAINT `m_loc_kelurahan_id_kecamatan_fkey` FOREIGN KEY (`id_kecamatan`) REFERENCES `m_loc_kecamatan`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_orang` ADD CONSTRAINT `m_orang_tempat_lahir_id_fkey` FOREIGN KEY (`tempat_lahir_id`) REFERENCES `m_loc_provinsi`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_orang` ADD CONSTRAINT `m_orang_id_provinsi_fkey` FOREIGN KEY (`id_provinsi`) REFERENCES `m_loc_provinsi`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_orang` ADD CONSTRAINT `m_orang_id_kota_fkey` FOREIGN KEY (`id_kota`) REFERENCES `m_loc_kota`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_orang` ADD CONSTRAINT `m_orang_id_kecamatan_fkey` FOREIGN KEY (`id_kecamatan`) REFERENCES `m_loc_kecamatan`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_orang` ADD CONSTRAINT `m_orang_id_kelurahan_fkey` FOREIGN KEY (`id_kelurahan`) REFERENCES `m_loc_kelurahan`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_orang` ADD CONSTRAINT `m_orang_pkr_id_pekerjaan_fkey` FOREIGN KEY (`pkr_id_pekerjaan`) REFERENCES `m_pekerjaan`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_orang` ADD CONSTRAINT `m_orang_id_keahlian_fkey` FOREIGN KEY (`id_keahlian`) REFERENCES `m_keahlian`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_orang` ADD CONSTRAINT `m_orang_id_tlb_fkey` FOREIGN KEY (`id_tlb`) REFERENCES `m_tlb`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_pelanggan` ADD CONSTRAINT `m_pelanggan_id_orang_fkey` FOREIGN KEY (`id_orang`) REFERENCES `m_orang`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_pelanggan` ADD CONSTRAINT `m_pelanggan_kode_pelanggan_fkey` FOREIGN KEY (`kode_pelanggan`) REFERENCES `m_kantor`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_pelanggan` ADD CONSTRAINT `m_pelanggan_id_status_pelanggan_fkey` FOREIGN KEY (`id_status_pelanggan`) REFERENCES `m_status_pelanggan`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `m_pelanggan` ADD CONSTRAINT `m_pelanggan_id_posisi_administrasi_fkey` FOREIGN KEY (`id_posisi_administrasi`) REFERENCES `m_pos_administrasi`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `relasi_pelanggan` ADD CONSTRAINT `relasi_pelanggan_id_dari_pelanggan_fkey` FOREIGN KEY (`id_dari_pelanggan`) REFERENCES `m_pelanggan`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `relasi_pelanggan` ADD CONSTRAINT `relasi_pelanggan_id_ke_pelanggan_fkey` FOREIGN KEY (`id_ke_pelanggan`) REFERENCES `m_pelanggan`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `relasi_pelanggan` ADD CONSTRAINT `relasi_pelanggan_id_relasi_fkey` FOREIGN KEY (`id_relasi`) REFERENCES `m_relasi_pel`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE `h_grade_pelanggan` ADD CONSTRAINT `h_grade_pelanggan_id_pelanggan_fkey` FOREIGN KEY (`id_pelanggan`) REFERENCES `m_pelanggan`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
