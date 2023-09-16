<template>
<div class="container" style="max-width: 100% !important;margin: 0;">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">Overall Attendance</div>

                <div class="card-body">
                  <Bar
                    id="my-chart-id"
                    :options="chartOptions"
                    :data="allData"
                  />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Members Attendance</div>

                <div class="card-body">
                  <Bar
                    id="my-chart-id"
                    :options="chartOptions"
                    :data="memberData"
                  />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Guests Attendance</div>

                <div class="card-body">
                  <Bar
                    id="my-chart-id"
                    :options="chartOptions"
                    :data="guestData"
                  />
                </div>
            </div>
        </div>
        <div class="col-md-8">

          <div class="row">
            <div class="col-md-7">
              <div class="card mb-3">
                <div class="card-header">Attendance Trend</div>

                <div class="card-body">
                  <LineChartGenerator :data="trendData" :options="chartOptions" />
                </div>
              </div>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-header">Attendance Progress Per Local Church</div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-6 mb-4" v-for="data in progressData">
                  <small>{{ data.local_church }}</small> <br />
                  <el-progress class="d-inline" :text-inside="true" :stroke-width="15"  :percentage="data.percentage"></el-progress>&nbsp;&nbsp;<small>{{ data.actual_attendance }} out of {{ data.expected_attendance }} is present today &nbsp;<el-link style="font-size: 0.875em;" type="primary" :underline="true">View Details</el-link></small>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
  </template>
  
  <script lang="ts">
  import { Bar } from 'vue-chartjs';
  import { Line as LineChartGenerator } from 'vue-chartjs'

  import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, PointElement, LineElement } from 'chart.js'
  
  ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, PointElement, LineElement)

  export default {
    props: {
      all : {
        type: Object,
        default: false
      },
      members : {
        type: Object,
        default: false
      },
      guests : {
        type: Object,
        default: false
      },
      trend : {
        type: Object,
        default: false
      },
      progress : {
        type: Object,
        defaults: false
      }
    },
    name: 'BarChart',
    components: { Bar, LineChartGenerator },
    data() {
      return {
        allData: this.all.data,
        memberData: this.members.data,
        guestData: this.guests.data,
        trendData: this.trend,
        progressData: this.progress,
        chartOptions: {
          responsive: true,
          maintainAspectRatio: true
        }
      }
    },
    methods: {
      format(percentage) {
        return `${percentage}%`;
      }
    }
  }
  </script>