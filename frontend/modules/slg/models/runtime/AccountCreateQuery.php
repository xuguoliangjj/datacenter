<?php

namespace frontend\modules\slg\models\runtime;

/**
 * This is the ActiveQuery class for [[AccountCreate]].
 *
 * @see AccountCreate
 */
class AccountCreateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AccountCreate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AccountCreate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
