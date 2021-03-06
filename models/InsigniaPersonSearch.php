<?php

namespace andahrm\insignia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use andahrm\insignia\models\InsigniaPerson;

/**
 * InsigniaPersonSearch represents the model behind the search form of `andahrm\insignia\models\InsigniaPerson`.
 */
class InsigniaPersonSearch extends InsigniaPerson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insignia_type_id', 'position_id', 'edoc_insignia_id', 'user_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['yearly', 'feat', 'note'], 'safe'],
            [['salary'], 'number'],
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
        $query = InsigniaPerson::find();

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
            'insignia_type_id' => $this->insignia_type_id,
            'yearly' => $this->yearly,
            'salary' => $this->salary,
            'position_id' => $this->position_id,
            'edoc_insignia_id' => $this->edoc_insignia_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'feat', $this->feat])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
