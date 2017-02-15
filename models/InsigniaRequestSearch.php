<?php

namespace andahrm\insignia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use andahrm\insignia\models\InsigniaRequest;

/**
 * InsigniaRequestSearch represents the model behind the search form of `andahrm\insignia\models\InsigniaRequest`.
 */
class InsigniaRequestSearch extends InsigniaRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_type_id', 'insignia_type_id', 'gender', 'status', 'edoc_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['year', 'certificate_offer_name', 'certificate_offer_date'], 'safe'],
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
        $query = InsigniaRequest::find();

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
            'person_type_id' => $this->person_type_id,
            'year' => $this->year,
            'insignia_type_id' => $this->insignia_type_id,
            'gender' => $this->gender,
            'status' => $this->status,
            'certificate_offer_date' => $this->certificate_offer_date,
            'edoc_id' => $this->edoc_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'certificate_offer_name', $this->certificate_offer_name]);

        return $dataProvider;
    }
}
