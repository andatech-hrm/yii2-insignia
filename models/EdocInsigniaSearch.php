<?php

namespace andahrm\insignia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use andahrm\edoc\models\EdocInsignia;

/**
 * EdocInsigniaSearch represents the model behind the search form of `andahrm\edoc\models\EdocInsignia`.
 */
class EdocInsigniaSearch extends EdocInsignia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['book_number', 'part_number', 'book_at', 'public_date', 'book_date', 'file', 'file_name'], 'safe'],
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
        $query = EdocInsignia::find();

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
            'public_date' => $this->public_date,
            'book_date' => $this->book_date,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'book_number', $this->book_number])
            ->andFilterWhere(['like', 'part_number', $this->part_number])
            ->andFilterWhere(['like', 'book_at', $this->book_at])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}
