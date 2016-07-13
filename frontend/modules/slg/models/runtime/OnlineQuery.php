<?php

namespace frontend\modules\slg\models\runtime;

/**
 * This is the ActiveQuery class for [[Online]].
 *
 * @see Online
 */
class OnlineQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Online[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Online|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
