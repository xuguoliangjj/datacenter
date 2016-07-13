<?php

namespace frontend\modules\slg\models\runtime;

/**
 * This is the ActiveQuery class for [[PlayLevel]].
 *
 * @see PlayLevel
 */
class PlayLevelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PlayLevel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PlayLevel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
