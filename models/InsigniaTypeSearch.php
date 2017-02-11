<?php

namespace andahrm\insignia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use andahrm\insignia\models\InsigniaType;

/**
 * InsigniaTypeSearch represents the model behind the search form of `andahrm\insignia\models\InsigniaType`.
 */
class InsigniaTypeSearch extends InsigniaType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['title_full', 'title', 'marker', 'marker_scope', 'marker_cropped'], 'safe'],
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
        $query = InsigniaType::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title_full', $this->title])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'marker', $this->marker])
            ->andFilterWhere(['like', 'marker_scope', $this->marker_scope])
            ->andFilterWhere(['like', 'marker_cropped', $this->marker_cropped]);

        return $dataProvider;
    }
}
