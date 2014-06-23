<?php
$locationDropDownArray = CHtml::listData(Location::getLocationArray(),'id','name');
array_unshift($locationDropDownArray,  Yii::t('common', 'Select location'));
?>
<div class="<?php echo $divClass; ?>">
        <span class="search"><div class="<?php echo $textClass; ?>"><?php echo tc('Country') ?>:</div></span>

<?php
echo CHtml::dropDownList(
    'location',
    'Выберите город',
     $locationDropDownArray,
    array('class' => $fieldClass . ' searchField', 'id' => 'country',
        'ajax' => array(
            'type'=>'GET', //request type
            'url'=>$this->createUrl('/sublocation/getSublocations'), //url to call.
            'data'=>'js:"location="+$("#country").val()',
            'success'=>"function(result) {
                           var obj = jQuery.parseJSON(result);
                           $('#selectSublocation').empty();
                           $.each( obj, function( key, value ) {
                                $('#selectSublocation').append(
                                '<option value=\"'+value.id+'\">'+value.name+'</option>'
                                )

                            });
						}"
        )
    )
);

?>
</div>
<div class="<?php echo $divClass; ?>">
    <span class="search"><div class="<?php echo $textClass; ?>"><?php echo Yii::t('common', 'City') ?>:</div></span>

    <?php

    echo CHtml::dropDownList(
        'sublocation',
        '',
        array(),
        array('id'=>'selectSublocation','class' => 'width285 height17 searchField') //$fieldClass.
    );

    SearchForm::setJsParam('cityField', array('minWidth' => $minWidth)); //

    ?>
</div>
<?php
