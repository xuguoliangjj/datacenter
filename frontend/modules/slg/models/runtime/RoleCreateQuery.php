<?php

namespace frontend\modules\slg\models\runtime;

/**
 * This is the ActiveQuery class for [[RoleCreate]].
 *
 * @see RoleCreate
 */
class RoleCreateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RoleCreate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RoleCreate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
