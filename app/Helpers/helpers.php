<?php

use App\Jobs\ResizeProductImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;


// позволяет избежать возможную коллизию
if(!function_exists('updateOrCreateProductGallery')) {

    /**
     * Создает, либо обновляет галлерею продукта
     * @param array $images - галлерея изображений продкута
     * @param $product_id - id созданного продута
     * @param $imgUrl - cover обложка продукта (редактируется админом)
     * @return void
     */
    function updateOrCreateProductGallery(array $images = [], $product_id = null, $imgUrl = null) {

        // если мы добавляем новую галлерею товара
        // и передан id продукта, а также изображения товара
        if(is_null($imgUrl) && !is_null($product_id) && !is_null($images)) {

            $folder_with_month = Carbon::now()->format('FY');

            foreach($images as $key => $image) {

                // timestamp единый для всех изображений
                $timestamp = Carbon::now()->timestamp;

                // если изображение первое в списке, то оно обложка
                if($key == 0) {

                    // сохраняем его в папку products
                    $imgName = $timestamp . '.' . $image->extension();
                    $image_path = $image->storeAs('products/'. $folder_with_month, $imgName);

                    // добавлем ссылку на изображение и сохраняем его
                    DB::table('products')
                        ->where('id', $product_id)
                        ->update(['image' => $image_path]);

                    // дополнительные изображения товара
                } else {

                    // ресайз с 800pх
                    $imgName800 = $timestamp . '_800px.' . $image->extension();
                    $image_800_path = public_path('storage/products/'.$folder_with_month . '/' . $imgName800);
                    Image::make($image->temporaryUrl())->resize(800, 800)->save($image_800_path);
                    // ResizeProductImage::dispatch($image->temporaryUrl(), $image_800_path);

                    $imgName300 = $timestamp . '_300px.' . $image->extension();
                    // если нет дерриктироии preview, то создаем ее
                    $dir_preview = public_path('storage/products/'.$folder_with_month .'/preview');
                    if(!File::isDirectory($dir_preview)) File::makeDirectory($dir_preview);
                    // ресайз с 300px добавляем в папку preview
                    Image::make($image->temporaryUrl())->resize(300, 300)->save($dir_preview . '/' . $imgName300);
                    // ResizeProductImage::dispatch($image->temporaryUrl(), $dir_preview . '/' . $imgName300, 300);

                    // сохраняем в таблицу media
                    DB::table('media')->insert([
                        'image_path' => $image_800_path,
                        'resize_image_path' => $dir_preview . '/' . $imgName300,
                        'product_id' => $product_id,
                        'status' => 0, // по умолчанию, не одобрено
                        'created_at' => now()
                    ]);
                }
            }

            // отправляем в очередь обработку изображений
            //ResizeProductImage::dispatch($images, $product_id);

        // иначе если админ обновляет на стр. редактирования обложку товара
        } else {
            // TODO доделать блок редактирования изображений
        }
    }
}
