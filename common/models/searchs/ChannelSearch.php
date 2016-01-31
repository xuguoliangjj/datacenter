<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\channel;

/**
 * ChannelSearch represents the model behind the search form about `common\models\channel`.
 */
class ChannelSearch extends channel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'app_id'], 'integer'],
            [['channel'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = channel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'app_id' => $this->app_id,
        ]);

        $query->andFilterWhere(['like', 'channel', $this->channel]);

        return $dataProvider;
    }
}
