/*
  Warnings:

  - Added the required column `created_by_user` to the `pelanggan` table without a default value. This is not possible if the table is not empty.

*/
-- AlterTable
ALTER TABLE `pelanggan` ADD COLUMN `created_at` DATETIME(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
    ADD COLUMN `created_by_user` INTEGER NOT NULL;

-- CreateTable
-- history grade pelanggan
CREATE TABLE `h_grade_pelanggan` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_pelanggan` INTEGER NOT NULL,
    `grade` VARCHAR(191) NOT NULL,
    `created_by_user` INTEGER NOT NULL,
    `created_at` DATETIME(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
-- History input/edit data
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
ALTER TABLE `h_grade_pelanggan` ADD CONSTRAINT `h_grade_pelanggan_id_pelanggan_fkey` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
