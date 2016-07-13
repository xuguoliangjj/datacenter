<?php

namespace frontend\modules\slg\models\runtime;

/**
 * This is the ActiveQuery class for [[Pay]].
 *
 * @see Pay
 */
class PayQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Pay[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Pay|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
