<?php $__env->startSection('title', 'Новое объявление'); ?>
<?php $__env->startSection('main'); ?>

    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-12">
                    <!-- Start Dashboard Sidebar -->
                <?php echo $__env->make('layouts.dashboard_profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <!-- Start Dashboard Sidebar -->
                </div>
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">
                        <!-- Start Post Ad Block Area -->
                        <div class="dashboard-block mt-0">
                            <div class="block-head">
                                <h3 class="block-title">Новое объявление</h3>
                                <div class="block-actions">
                                    <a class="btn alt-btn" href="<?php echo e(route('mybb')); ?>">К моим объявлениям</a>
                                </div>
                            </div>
                            <form  action="<?php echo e(route('addBbToDB')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                            <div class="inner-block">


                                <!-- Start Post Ad Tab -->
                                <div class="post-ad-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-item-info-tab" data-bs-toggle="tab" data-bs-target="#nav-item-info" type="button" role="tab" aria-controls="nav-item-info" aria-selected="true">
                                                <span class="serial">01</span>
                                                Шаг
                                                <span class="sub-title">Общая информация</span>
                                            </button>
                                            <button class="nav-link" id="nav-item-details-tab" data-bs-toggle="tab" data-bs-target="#nav-item-details" type="button" role="tab" aria-controls="nav-item-details" aria-selected="false">
                                                <span class="serial">02</span>
                                                Шаг
                                                <span class="sub-title">Фото и описание</span>
                                            </button>
                                            <button class="nav-link" id="nav-user-info-tab" data-bs-toggle="tab" data-bs-target="#nav-user-info" type="button" role="tab" aria-controls="nav-user-info" aria-selected="false">
                                                <span class="serial">03</span>
                                                Шаг
                                                <span class="sub-title">Контактные данные</span>
                                            </button>
                                        </div>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade active show" id="nav-item-info" role="tabpanel" aria-labelledby="nav-item-info-tab">
                                            <!-- Start Post Ad Step One Content -->
                                            <div class="step-one-content">
                                                <div class="default-form-style">
                                                    <div class="row">



                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Раздел</label>
                                                                <?php $__errorArgs = ['rubric_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback">
<strong><?php echo e($message); ?></strong>
</span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                <div class="selector-head">

                                                                    <div id="container_rubric_0" class="container_rubric"></div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>Производитель</label>
                                                                    <div class="selector-head">
                                                                    <span class="arrow"><i class="lni lni-chevron-down"></i></span>
    <?php
        use App\Models\Location;
        use App\Models\Rubric;
        $vendors = App\Models\Vendor::get();
    ?>
                                                                    <select class="user-chosen-select" name="vendor_id" data-name="vendor_id" required>
                                                                        <option selected disabled>- выбрать -</option>

                                                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($vendor->id); ?>" <?php if(old('vendor_id')==$vendor->id): ?> selected <?php endif; ?> ><?php echo e($vendor->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>Модель</label>
                                                                <input value="<?php echo e(old('title')); ?>" name="title" type="text" data-name="title">
                                                            </div>
                                                        </div>


                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Цена</label>
                                                                <input name="price" type="number" step="0.01" value="<?php echo e(old('price')); ?>"   id="price" data-name="price" min="1">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                            <label class="form-label">Вид цены</label>

                                                            <div class="selector-head">
                                                                <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                            <select class="user-chosen-select" name="price_type"  required data-name="price_type">
                                                                <option selected disabled>- выбрать -</option>
                                                                <?php if(count($price_types)>0): ?>
                                                                <?php $__currentLoopData = $price_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                    <option value="<?php echo e($price_type->id); ?>" id="pricetype_<?php echo e($price_type->id); ?>" class="input-pricetype" <?php if(old('price_type')==$price_type->id): ?> selected <?php endif; ?> ><?php echo e($price_type->type); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group button mb-0">
                                                                <button type="button" class="btn " onclick="selectTab('nav-item-details',['rubric','title','vendor_id','price','price_type'])">Далее</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Post Ad Step One Content -->
                                        </div>
                                        <div class="tab-pane fade" id="nav-item-details" role="tabpanel" aria-labelledby="nav-item-details-tab">
                                            <!-- Start Post Ad Step Two Content -->
                                            <div class="step-two-content">
                                                <div class="default-form-style">
                                                    <div class="row">
                                                        <?php if(count($parameters)>0): ?>
                                                            <?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parameter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($parameter->type == 'options'): ?>
                                                                    <div class="col-6" style="display:none">
                                                                        <div class="mb-3 input-parameter" id="parameter_<?php echo e($parameter->id); ?>">
                                                                            <label  class="form-label"><?php echo e($parameter->name); ?><?php if ($parameter->measure) echo ', '.$parameter->measure?>
                                                                            </label>
                                                                            <select class="form-select" name="parameter[<?php echo e($parameter->id); ?>]" >
                                                                                <option disabled selected>- выбрать -</option>
                                                                                <?php
                                                                                $options = json_decode($parameter->options);
                                                                                ?>
                                                                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($option); ?>"><?php echo e($option); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                <?php elseif($parameter->type == 'checkbox'): ?>
                                                                    <div class="col-6" style="display:none">

                                                                        <div class="mb-3 input-parameter" id="parameter_<?php echo e($parameter->id); ?>">
                                                                            <label  class="form-label"><?php echo e($parameter->name); ?><?php  if ($parameter->measure) {echo ', '.$parameter->measure;}?>
                                                                            </label>
                                                                        <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input width-auto" name="parameter[<?php echo e($parameter->id); ?>]" value="Y">
                                                                            <label class="form-check-label">Да</label>
                                                                        </div>
                                                                        </div>

                                                                    </div>
                                                                <?php elseif($parameter->type == 'number'): ?>
                                                                    <div class="col-6" style="display:none">
                                                                        <div class="mb-3 input-parameter" id="parameter_<?php echo e($parameter->id); ?>">
                                                                            <label class="form-label"><?php echo e($parameter->name); ?><?php  if ($parameter->measure) {echo ', '.$parameter->measure;}?>
                                                                            </label>
                                                                            <input type="<?php echo e($parameter->type); ?>" step="0.01" name="parameter[<?php echo e($parameter->id); ?>]" class="form-control" <?php if($parameter->max): ?> max="<?php echo e($parameter->max); ?>" <?php endif; ?> <?php if($parameter->min): ?>min="<?php echo e($parameter->min); ?>" <?php endif; ?>>
                                                                        </div>
                                                                    </div>
                                                                <?php elseif($parameter->type == 'year'): ?>
                                                                    <div class="col-6" style="display:none">
                                                                        <div class="mb-3 input-parameter" id="parameter_<?php echo e($parameter->id); ?>">
                                                                            <label class="form-label"><?php echo e($parameter->name); ?><?php  if ($parameter->measure) {echo ', '.$parameter->measure;}?>
                                                                            </label>
                                                                            <input type="number"   name="parameter[<?php echo e($parameter->id); ?>]" class="form-control" max="<?php echo date('Y'); ?>" <?php if($parameter->min): ?>min="<?php echo e($parameter->min); ?>" <?php endif; ?>>
                                                                        </div>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="col-6" style="display:none">
                                                                        <div class="mb-3 input-parameter" id="parameter_<?php echo e($parameter->id); ?>">
                                                                            <label class="form-label"><?php echo e($parameter->name); ?> <?php if ($parameter->measure) {echo ', '.$parameter->measure;}?>
                                                                            </label>
                                                                            <input type="<?php echo e($parameter->type); ?>" name="parameter[<?php echo e($parameter->id); ?>]" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>

<div class="col-12">
                                                            <div class="form-group upload-photo">
                                                                <label>Фотографии</label>
                                                                <input type="file" name="file" accept="image/*">
                                                            </div>
                                                        </div>


                                                        <div class="col-12">
                                                            <div class="form-group mt-30">
                                                                <label>Описание</label>
                                                                <textarea name="description" placeholder=""><?php echo e(old('description')); ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group button mb-0">
                                                                <button type="button" class="btn alt-btn"  onclick="selectTab('nav-item-info')">Назад</button>
                                                                <button type="button" class="btn "  onclick="selectTab('nav-user-info')">Далее</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Post Ad Step Two Content -->
                                        </div>
                                        <div class="tab-pane fade" id="nav-user-info" role="tabpanel" aria-labelledby="nav-user-info-tab">
                                            <!-- Start Post Ad Step Three Content -->
                                            <div class="step-three-content">
                                                <div class="default-form-style" >
                                                    <div class="row">


                                                        <?php $__currentLoopData = $contact_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($contact_type->mask): ?>
                                                                <script>
                                                                    window.addEventListener("load", function(){
                                                                        $("#contact_<?php echo e($contact_type->id); ?>").mask("<?php echo e($contact_type->mask); ?>")
                                                                    });
                                                                </script>

                                                            <?php endif; ?>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                <label class="form-label"><?php echo e($contact_type->name); ?></label>
                                                                <input type="text" value="" name="contact[<?php echo e($contact_type->id); ?>]"
                                                                        id="contact_<?php echo e($contact_type->id); ?>"
                                                                       <?php if($contact_type->required == 'Y'): ?>
                                                                       required
                                                                    <?php endif; ?>
                                                                >

                                                            </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Город</label>
                                                                <div class="selector-head">

                                                                    <div id="container_location_0" class="container_location"></div>

                                                                </div>
                                                            </div>
                                                        </div>


                                                            <div class="col-12">
                                                                <div class="form-group button mb-0">
                                                                    <button type="button" class="btn alt-btn" onclick="selectTab('nav-item-details')">Назад</button>
                                                                    <button type="submit" class="btn ">Добавить</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Post Ad Step Three Content -->
                                        </div>
                                    </div>

                                </div>

                                <!-- End Post Ad Tab -->
                            </div>
                           </form>
                        </div>
                        <!-- End Post Ad Block Area -->
                    </div>
                </div>
            </div>
        </div>
    </section>





    <script>

        window.addEventListener("load", function(){

            window.json_rubric = <?php echo json_encode($rubrics, 15, 512) ?>;
            window.json_location = <?php echo json_encode($locations, 15, 512) ?>;
            window.json_parameter_rubric = <?php echo json_encode($parameter_rubric, 15, 512) ?>;
            window.json_pricetype_rubric = <?php echo json_encode($price_type_rubric, 15, 512) ?>;

            $("input[name*='parameter']").change(function () {
                if (typeof ($(this).attr("min"))!= "undefined")
                {
                    var min = $(this).attr("min");
                    if ($(this).val()<=min) $(this).val(min)
                    console.log(min+' '+$(this).val)
                }

                if (typeof ($(this).attr("max"))!= "undefined")
                {
                    var max = $(this).attr("max");
                    if ($(this).val()>=max) $(this).val(max)
                    console.log(max+' '+$(this).val)
                }
            });
            NewSelect('rubric');

            NewSelect('location');
            //$('.input-images').imageUploader();


        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/bb/add.blade.php ENDPATH**/ ?>