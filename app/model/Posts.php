<?php
/** 
 * /app/Model/Posts.php
 */
class Posts extends AppModel 
{
    /** �g�p�e�[�u���� */
    public $useTable = 'posts';

    /** ��L�[(�ȗ����́uid�v�ɂȂ�̂ŏȗ�����) */
    public $primaryKey = 'id';

    //���f�����������ʃ��f��Terms���֘A�t����
    //Posts(��) => Terms(��)�@�̊֌W
    public $belongsTo = array(
        'Terms' => array(
            'foreignKey' => 'term_id'    //�O���L�[
        )
    );

    //Posts�ɑ΂��ĕ����̃��R�[�h�����鉺�ʃ��f��Comments���w��
    public $hasMany = array('Comments');

}