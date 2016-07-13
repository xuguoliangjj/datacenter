<?php

namespace frontend\modules\slg\models\runtime;

/**
 * This is the ActiveQuery class for [[Logout]].
 *
 * @see Logout
 */
class LogoutQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Logout[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Logout|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
