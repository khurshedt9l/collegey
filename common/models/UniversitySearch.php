<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\University;

/**
 * UniversitySearch represents the model behind the search form about `common\models\University`.
 */
class UniversitySearch extends University
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'important_links_id', 'download_links_id', 'is_verified', 'is_featured', 'status', 'statutory_body_id'], 'integer'],
            [['name', 'description', 'website', 'logo', 'banner', 'establish', 'created', 'updated', 'image'], 'safe'],
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
        $query = University::find();

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
            'establish' => $this->establish,
            'important_links_id' => $this->important_links_id,
            'download_links_id' => $this->download_links_id,
            'is_verified' => $this->is_verified,
            'is_featured' => $this->is_featured,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
            'statutory_body_id' => $this->statutory_body_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
