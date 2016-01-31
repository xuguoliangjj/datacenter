<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\app;

/**
 * AppSearch represents the model behind the search form about `common\models\app`.
 */
class AppSearch extends app
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'cp_id', 'active'], 'integer'],
            [['app_name', 'app_id', 'app_secret', 'app_code', 'tbl_prefix', 'version'], 'safe'],
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
        $query = app::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'cp_id' => $this->cp_id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'app_name', $this->app_name])
            ->andFilterWhere(['like', 'app_id', $this->app_id])
            ->andFilterWhere(['like', 'app_secret', $this->app_secret])
            ->andFilterWhere(['like', 'app_code', $this->app_code])
            ->andFilterWhere(['like', 'tbl_prefix', $this->tbl_prefix])
            ->andFilterWhere(['like', 'version', $this->version]);

        return $dataProvider;
    }
}
